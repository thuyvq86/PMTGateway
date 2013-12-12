<?php

class BillPaymentController extends Controller
{

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),			
		);
	}
	
	public function actionSend()
	{									
		if(isset($_POST['REQUIRE_FIEDS']))
		{				
			$require_fields_arr = $_POST["REQUIRE_FIEDS"];
		}		
		
		echo $require_fields_arr["unsigned_field_names"];
		
		if(isset($_POST['BILLS']))
		{				
			$bills_arr = $_POST["BILLS"];
		}	
		$paramsfields = array();
		foreach($require_fields_arr as $key => $value){						
			$paramsfields[$key] = $value;
		}			
		foreach($bills_arr as $key => $value){						
			$paramsfields[$key] = $value;
		}
		
		if(isset($_POST['ReturnURL']))
		{				
			$returnURL = $_POST["ReturnURL"];
		}			
		if(isset($_POST['merchant_name']))
		{				
			$merchant_name = $_POST["merchant_name"];
		}	
		
		//$url = $this -> createUrl("BillPayment/config");
		//$this -> redirect($url);
		//Create Bills Object
		$billmodel = new BillForm;							
		$billmodel->firstname = $bills_arr["bill_to_forename"];				
		$billmodel->lastname = $bills_arr["bill_to_surname"];
		$billmodel->company = $bills_arr["bill_to_company_name"];
		$billmodel->address1 = $bills_arr["bill_to_address_line1"];
		$billmodel->address2 = $bills_arr["bill_to_address_line2"];
		$billmodel->city = $bills_arr["bill_to_address_city"];
		$billmodel->country = $bills_arr["bill_to_address_country"];
		$billmodel->zipcode = $bills_arr["bill_to_address_postal_code"];
		$billmodel->state = $bills_arr["bill_to_address_state"];
		$billmodel->email = $bills_arr["bill_to_email"];
		$billmodel->phone = $bills_arr["bill_to_phone"];
		$billmodel->amount = $bills_arr["amount"];
		$billmodel->currency = $bills_arr["currency"];		
		$billmodel->refnumber = $require_fields_arr["reference_number"];				
		//========================================
		$SECRET_KEY = "";
		if(isset($_SESSION['SECRET_KEY']))
		{				
			$SECRET_KEY = $_SESSION['SECRET_KEY'];												
			unset($_SESSION['SECRET_KEY']);			
		}				
		
		$billmodel->signature = $this->sign($paramsfields, $SECRET_KEY);					
		$paramsfields["signature"] = $billmodel->signature;
											
		//Save bill
		$this -> saveBills($billmodel);
		
		
		$requestbody = "<form id=\"frm1\" action=\"https://testsecureacceptance.cybersource.com/pay\" method=\"post\">" . "\n";		
		foreach($paramsfields as $key => $value)	{
			//echo $key  . "-" . $value . "<br>";
			$requestbody .= "<input type=\"hidden\" id=\"". $key . "\" name=\"". $key . "\" value=\"" . $value . "\">" . "\n";
		}			
		
		$requestbody .= "</form>";
		//echo $requestbody;
		echo $requestbody . "<script>document.getElementById('frm1').submit();</script>";
								
		//Save request log
		$this->saveLogRequest($billmodel, $merchant_name,$requestbody);				
		
	}
			
	public function actionError()
	{			
		$error	= "";
		if(isset($_GET['ErrMsg'])){
			$error = $_GET['ErrMsg'];
		}
		
		$this->render('error',array('errorMsg'=>$error));
	}
		

	public function actionBillPayment()
	{					
		if($_SERVER['REQUEST_METHOD'] == "GET")
		{
			$err = "REQUEST INVALID. METHOD REQUEST: " . $_SERVER['REQUEST_METHOD'];			
			$url = $this -> createUrl("BillPayment/error", array('ErrMsg'=>$err));			
			$this -> redirect($url);
			return;
		}
		
		$provider_code = "";		
		if(isset($_POST['provider_code']))
		{				
			$provider_code = $_POST['provider_code'];
		}
		if($provider_code == "")
		{									
			$err = "Can not find the provider_code";	
			$url = $this -> createUrl("BillPayment/error", array('ErrMsg'=>$err));			
			$this -> redirect($url);
			return;
		}
		
		$billmodel=new BillForm;		
		//Connect DB	
		$sqlStatement = 'SELECT *
						FROM cp_integrationprofile , cp_integrationfields
						WHERE cp_integrationprofile.ID = cp_integrationfields.ProfileID AND ProviderCode = :ProviderCode';
		$connection = Yii::app() -> db;
		$connection -> active = true;
		$command = $connection -> createCommand($sqlStatement);
				
		$command -> bindParam(":ProviderCode", $provider_code, PDO::PARAM_STR);		
		$reader = $command -> query();
		$connection -> active = false;
		
		$merFields = array();						
		
		if($reader -> rowCount == 0)
		{			
			$err = "Can not find your Merchant";	
			$url = $this -> createUrl("BillPayment/error", array('ErrMsg'=>$err));			
			$this -> redirect($url);
			return;
		}
		else
		{
			foreach($reader as $row) 		
			{ 				
				$merName = $row["ProviderName"];
				$merFields[$row["DisplayName"]] = $row["Value"] ;				
			}		
								
		//=============================			
		if(isset($_POST['x_relay_response']))
		{				
			$billmodel->returnURL = $_POST["x_relay_response"];			
		}		
		if(isset($_POST['x_invoice_num']))
		{				
			$billmodel->invoiceid = $_POST["x_invoice_num"];			
		}			
		if(isset($_POST['bill_to_forename']))
		{				
			$billmodel->firstname = $_POST["bill_to_forename"];
		}
		if(isset($_POST['bill_to_surname']))
		{				
			$billmodel->lastname = $_POST["bill_to_surname"];
		}
		if(isset($_POST['bill_to_company_name']))
		{				
			$billmodel->company = $_POST["bill_to_company_name"];
		}
		if(isset($_POST['bill_to_address_line1']))
		{				
			$billmodel->address1 = $_POST["bill_to_address_line1"];
		}
		if(isset($_POST['bill_to_address_line2']))
		{				
			$billmodel->address2 = $_POST["bill_to_address_line2"];
		}
		if(isset($_POST['bill_to_address_city']))
		{				
			$billmodel->city = $_POST["bill_to_address_city"];
		}
		
		if(isset($_POST['bill_to_address_country']))
		{				
			$billmodel->country = $_POST["bill_to_address_country"];
		}
		if(isset($_POST['bill_to_address_postal_code']))
		{				
			$billmodel->zipcode = $_POST["bill_to_address_postal_code"];
		}
		if(isset($_POST['bill_to_address_state']))
		{				
			$billmodel->state = $_POST["bill_to_address_state"];
		}		
		if(isset($_POST['bill_to_email']))
		{				
			$billmodel->email = $_POST["bill_to_email"];
		}
		
		if(isset($_POST['bill_to_phone']))
		{				
			$billmodel->phone = $_POST["bill_to_phone"];
		}		
		if(isset($_POST['amount']))
		{				
			$billmodel->amount = $_POST["amount"];
		}		
		if(isset($_POST['currency']))
		{				
			$billmodel->currency = $_POST["currency"];
		}
		if(isset($_POST['x_fp_sequence']))
		{				
			$billmodel->refnumber = $_POST["x_fp_sequence"];
		}
		
		$billmodel->merchantname = $merName;
		
		//$billmodel->refnumber = (new DateTime()) -> getTimestamp();									
			
		$paramsfields = array();				
		//add require fields
		foreach($merFields as $key => $value){
			if($key != "SECRET_KEY" && $key != "signature"){
				if($key == "transaction_uuid") 
				{
					if($value == "NONE"){ $value = uniqid();} 
				}
				else if ($key == "unsigned_field_names") {
					if($value == "NONE"){ $value = "";} 
				}
				else if ($key == "signed_date_time") {
					if($value == "NONE"){ $value = gmdate("Y-m-d\TH:i:s\Z");} 
				}
				else if ($key == "reference_number") {
					if($value == "NONE"){ $value = $billmodel->refnumber;} 
				}				
				else if ($key == "merchant_secure_data1") {
					if($value == "NONE"){ $value = $billmodel->returnURL;} 
				}else if ($key == "merchant_secure_data2") {
					if($value == "NONE"){ $value = $billmodel->invoiceid;} 
				}	
			
				$paramsfields[$key] = $value;			
			}else
			{	
				if($key == "SECRET_KEY")
				{
					$_SESSION['SECRET_KEY'] = $merFields["SECRET_KEY"];																			
				}
			}
		}		
		$paramsfields["amount"] = $billmodel->amount;		
		$paramsfields["currency"] = $billmodel->currency;
						
		//Create signed_field_names from require fields
		$strSignFieldName = "";
		foreach($paramsfields as $key => $value){
			$strSignFieldName .= $key .",";
		}
				
		$strSignFieldName .= "bill_to_forename,";
		$strSignFieldName .= "bill_to_surname,";
		$strSignFieldName .= "bill_to_address_line1,";
		$strSignFieldName .= "bill_to_address_line2,";
		$strSignFieldName .= "bill_to_address_city,";
		$strSignFieldName .= "bill_to_address_country,";
		$strSignFieldName .= "bill_to_address_postal_code,";
		$strSignFieldName .= "bill_to_address_state,";
		$strSignFieldName .= "bill_to_email,";
		$strSignFieldName .= "bill_to_company_name,";
		$strSignFieldName .= "bill_to_phone";
		
		/*$paramsfields["bill_to_forename"] = $billmodel->firstname;
		$paramsfields["bill_to_surname"] = $billmodel->lastname;
		$paramsfields["bill_to_address_line1"] = $billmodel->address1;
		$paramsfields["bill_to_address_line2"] = $billmodel->address2;
		$paramsfields["bill_to_address_city"] = $billmodel->city;
		$paramsfields["bill_to_address_country"] = $billmodel->country;
		$paramsfields["bill_to_address_postal_code"] = $billmodel->zipcode;
		$paramsfields["bill_to_address_state"] = $billmodel->state;
		$paramsfields["bill_to_email"] = $billmodel->email;
		$paramsfields["bill_to_company_name"] = $billmodel->company;
		$paramsfields["bill_to_phone"] = $billmodel->phone;*/				
		//$strSignFieldName = substr($strSignFieldName, 0, strlen($strSignFieldName) -1);
				
		$paramsfields["signed_field_names"] = $strSignFieldName;
		
		
		//$signature = $this->sign($paramsfields, $merFields["SECRET_KEY"]);		
		//$billmodel->signature = $signature;
		$this->render('BillPayment',array('model'=>$billmodel, 'data' => $paramsfields));			
		
	}
}
	
	private function saveBills($billModel)
	{		
		$connection = Yii::app() -> db;
		$connection -> active = true;
		
		// Delete all old field of merchant
		/*$sql = "delete from PMTGateway.CP_IntegrationFields where ProfileID = :profileId";
		$command = $connection -> createCommand($sql);
		$command -> bindParam(":profileId", $profileId, PDO::PARAM_INT);
		$command -> execute();*/
		
		// Insert new		
		$today = date("Y-m-d H:i:s");
		$sql = "INSERT INTO cp_epaybillinfo
				(FirstName, LastName, AddressLine1, AddressLine2, City, Country, ZipCode, State, Company, Email, Phone, TrxnDate, Amount, Currency, ReferenceNumber)
				values (:FirstName, :LastName, :AddressLine1, :AddressLine2, :City, :Country, :ZipCode, :State, :Company, :Email, :Phone, :TrxnDate, :Amount, :Currency, :ReferenceNumber)";
		
		$command = $connection -> createCommand($sql);
		$command -> bindParam(":FirstName", $billModel->firstname, PDO::PARAM_STR);		
		$command -> bindParam(":LastName", $billModel->lastname, PDO::PARAM_STR);
		$command -> bindParam(":AddressLine1", $billModel->address1, PDO::PARAM_STR);
		$command -> bindParam(":AddressLine2", $billModel->address2, PDO::PARAM_STR);
		$command -> bindParam(":City", $billModel->city, PDO::PARAM_STR);
		$command -> bindParam(":Country", $billModel->country, PDO::PARAM_STR);
		$command -> bindParam(":ZipCode", $billModel->zipcode, PDO::PARAM_STR);
		$command -> bindParam(":State", $billModel->state, PDO::PARAM_STR);
		$command -> bindParam(":Company", $billModel->company, PDO::PARAM_STR);
		$command -> bindParam(":Email", $billModel->email, PDO::PARAM_STR);
		$command -> bindParam(":Phone", $billModel->phone, PDO::PARAM_STR);
		$command -> bindParam(":TrxnDate", $today, PDO::PARAM_STR);
		$command -> bindParam(":Amount", $billModel->amount, PDO::PARAM_STR);
		$command -> bindParam(":Currency", $billModel->currency, PDO::PARAM_STR);		
		$command -> bindParam(":ReferenceNumber", $billModel->refnumber, PDO::PARAM_STR);		
		$command -> execute();
		$connection -> active = false;		
	}
	
	private function saveLogRequest($billModel, $merchant, $request)
	{		
		$connection = Yii::app() -> db;
		$connection -> active = true;				
		
		// Insert new		
		$today = date("Y-m-d H:i:s");
		$sql = "
			INSERT INTO cp_requestlog
			(MerchantName, ReferenceNumber, Signature, RequestBody, TrxnDateTime) 
			VALUES (:MerchantName, :ReferenceNumber, :Signature,  :RequestBody, :TrxnDateTime)
			";
		$command = $connection -> createCommand($sql);
		$command -> bindParam(":MerchantName", $merchant, PDO::PARAM_STR);		
		$command -> bindParam(":ReferenceNumber", $billModel->refnumber, PDO::PARAM_STR);
		$command -> bindParam(":Signature", $billModel->signature, PDO::PARAM_STR);		
		$command -> bindParam(":RequestBody",$request, PDO::PARAM_STR);		
		$command -> bindParam(":TrxnDateTime", $today, PDO::PARAM_STR);
		$command -> execute();
		$connection -> active = false;		
	}
	
	function sign ($params, $secretkey) {	  
	  return $this->signData($this->buildDataToSign($params), $secretkey);
	}

	function signData($data, $secretKey) {
		return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
	}

	function buildDataToSign($params) {			
			$signedFieldNames = explode(",",$params["signed_field_names"]);			
			foreach ($signedFieldNames as $key => $value){								
				//echo $value. "=" . $params[$value];
				 $dataToSign[] = $value. "=" . $params[$value];
			}			
			return $this->commaSeparate($dataToSign);
	}

	function commaSeparate ($dataToSign) {		
		return implode(",",$dataToSign);
	}
	
}
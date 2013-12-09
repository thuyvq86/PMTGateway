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
		if(isset($_POST['ReturnURL']))
		{				
			$returnURL = $_POST["ReturnURL"];
		}			
		if(isset($_POST['merchant_name']))
		{				
			$merchant_name = $_POST["merchant_name"];
		}
		if(isset($_POST['access_key']))
		{				
			$access_key = $_POST["access_key"];
		}
		
		if(isset($_POST['profile_id']))
		{				
			$profile_id = $_POST["profile_id"];
		}			
		if(isset($_POST['transaction_uuid']))
		{				
			$transaction_uuid = $_POST["transaction_uuid"];
		}		
		if(isset($_POST['signed_date_time']))
		{				
			$signed_date_time= $_POST["signed_date_time"];
		}	
		$billmodel = new BillForm;
		$billmodel = $this->getObjectBill();	
		/*$paramsfields = array();
		if(isset($_POST['paramfields']) == false)
		{
			echo 111;
		}
		else
		{
			$paramsfields = $_POST['paramfields'];
			echo $paramsfields['merchant_name'];					
		}*/
		//Create paramfields
		$paramsfields = array(								
			'access_key' => $access_key,
			'profile_id' => $profile_id,
			'transaction_uuid' => $transaction_uuid,			
			'unsigned_field_names' => '',
			'signed_date_time' => $signed_date_time,
			'locale' => 'en',
			'transaction_type' => 'authorization',
			'reference_number' => $billmodel->refnumber,
			'amount' => $billmodel->amount,
			'currency' => $billmodel->currency,
			'bill_to_forename' => $billmodel->firstname,
			'bill_to_surname' => $billmodel->lastname,
			'bill_to_address_line1' => $billmodel->address1,
			'bill_to_address_line2' => $billmodel->address2,
			'bill_to_address_city' => $billmodel->city,
			'bill_to_address_country' => $billmodel->country,
			'bill_to_address_postal_code' => $billmodel->zipcode,
			'bill_to_email' => $billmodel->email,
			'merchant_secure_data1' => $returnURL,
			'signed_field_names' => 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,bill_to_forename,bill_to_surname,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_country,bill_to_address_postal_code,bill_to_email,merchant_secure_data1',
		);				
		$SECRET_KEY = "";
		if(isset($_SESSION['SECRET_KEY']))
		{				
			$SECRET_KEY = $_SESSION['SECRET_KEY'];												
			unset($_SESSION['SECRET_KEY']);			
		}				
		
		$billmodel->signature = $this->sign($paramsfields, $SECRET_KEY);				
		//Save bill
		$this -> saveBills($billmodel);
		$requestbody = "<form id=\"frm1\" action=\"https://testsecureacceptance.cybersource.com/pay\" method=\"post\">
			<input type=\"hidden\" id =\"access_key\" name=\"access_key\" value=\"$access_key\">
			<input type=\"hidden\" id=\"profile_id\" name=\"profile_id\" value=\"$profile_id\">
			<input type=\"hidden\" id=\"transaction_uuid\" name=\"transaction_uuid\" value=\"$transaction_uuid\">			
			<input type=\"hidden\" id=\"transaction_type\" name=\"transaction_type\" value=\"authorization\">
			<input type=\"hidden\" id=\"signed_field_names\" name=\"signed_field_names\"
				   value=\"access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,bill_to_forename,bill_to_surname,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_country,bill_to_address_postal_code,bill_to_email,merchant_secure_data1\">
		   <input type=\"hidden\" id=\"unsigned_field_names\" name=\"unsigned_field_names\">
		   <input type=\"hidden\" id=\"signed_date_time\" name=\"signed_date_time\" value=\"$signed_date_time\">
		   <input type=\"hidden\" id=\"locale\" name=\"locale\" value=\"en\">
			<input type=\"hidden\" id=\"allow_payment_token_update\" name=\"allow_payment_token_update\" value = \"false\">
			<input type=\"hidden\" id=\"reference_number\" name=\"reference_number\" value=\"$billmodel->refnumber\">
			<input type=\"hidden\" id=\"amount\" name=\"amount\" value=\"$billmodel->amount\">
			<input type=\"hidden\" id=\"currency\" name=\"currency\" value=\"$billmodel->currency\">	
			<input type=\"hidden\" id=\"signature\" name=\"signature\" value=\"$billmodel->signature\">		
			<input type=\"hidden\" id=\"bill_payment\" name=\"bill_payment\" value=\"true\">			
			<input type=\"hidden\" id=\"bill_to_forename\" name=\"bill_to_forename\" value=\"$billmodel->firstname\">
			<input type=\"hidden\" id=\"bill_to_surname\" name=\"bill_to_surname\" value=\"$billmodel->lastname\">
			<input type=\"hidden\" id=\"bill_to_address_line1\" name=\"bill_to_address_line1\" value=\"$billmodel->address1\">
			<input type=\"hidden\" id=\"bill_to_address_line2\" name=\"bill_to_address_line2\" value=\"$billmodel->address2\">
			<input type=\"hidden\" id=\"bill_to_address_city\" name=\"bill_to_address_city\" value=\"$billmodel->city\">
			<input type=\"hidden\" id=\"bill_to_address_country\" name=\"bill_to_address_country\" value=\"$billmodel->country\">			
			<input type=\"hidden\" id=\"bill_to_address_postal_code\" name=\"bill_to_address_postal_code\" value=\"$billmodel->zipcode\">			
			<input type=\"hidden\" id=\"bill_to_email\" name=\"bill_to_email\" value=\"$billmodel->email\">
			<input type=\"hidden\" id=\"merchant_secure_data1\" name=\"merchant_secure_data1\" value=\"$returnURL\">
			</form>									
			<script>document.getElementById('frm1').submit();</script>						
			";					
			echo $requestbody;
			//<script>document.getElementById('frm1').submit();</script>						
		//Save request log
		$this->saveLogRequest($billmodel, $merchant_name,$requestbody);				
		$GLOBALS['GMonitorBill'] = $billmodel;
	}
	public function getObjectBill(){
		$billmodel = new BillForm;
		if(isset($_POST['reference_number']))
		{				
			$billmodel->refnumber= $_POST["reference_number"];
		}			
		if(isset($_POST['signature']))
		{				
			$billmodel->signature= $_POST["signature"];
		}	
		
		if(isset($_POST['amount']) && $_POST['amount'] != "")
		{				
			$billmodel->amount = $_POST["amount"];
		}else{
			$url = $this -> createUrl("BillPayment/config");
			$this -> redirect($url);
		}		
		if(isset($_POST['currency']) && $_POST['amount'] != "")
		{				
			$billmodel->currency= $_POST["currency"];
		}else{
			$url = $this -> createUrl("BillPayment/config");
			$this -> redirect($url);
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
		if(isset($_POST['bill_to_phone']))
		{				
			$billmodel->phone = $_POST["bill_to_phone"];
		}
		if(isset($_POST['bill_to_email']))
		{				
			$billmodel->email = $_POST["bill_to_email"];
		}
		if(isset($_POST['bill_to_address_line1']))
		{				
			$billmodel->address1 = $_POST["bill_to_address_line1"];
		}
		if(isset($_POST['bill_to_address_line2']))
		{				
			$billmodel->address2 = $_POST["bill_to_address_line2"];
		}
		if(isset($_POST['bill_to_address_country']))
		{				
			$billmodel->country = $_POST["bill_to_address_country"];
		}
		if(isset($_POST['bill_to_address_city']))
		{				
			$billmodel->city = $_POST["bill_to_address_city"];
		}		
		if(isset($_POST['bill_to_address_postal_code']))
		{				
			$billmodel->zipcode = $_POST["bill_to_address_postal_code"];
		}	
		if(isset($_POST['bill_to_address_state']))
		{				
			$billmodel->state = $_POST["bill_to_address_state"];
		}					
		return $billmodel;
	}
	public function actionBillPayment()
	{					
		if($_SERVER['REQUEST_METHOD'] == "GET")
		{
			echo "REQUEST INVALID. METHOD REQUEST: " . $_SERVER['REQUEST_METHOD'] ."<br>";						
		}
		
		$provider_code = "";		
		if(isset($_POST['provider_code']))
		{				
			$provider_code = $_POST['provider_code'];
		}
		if($provider_code == "")
		{						
			echo "Can not find your provider_code <br>";
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
			echo "Can not find your Merchant  <br>";										
		}
		else
		{
			foreach($reader as $row) 		
			{ 				
				$merName = $row["ProviderName"];
				$merFields[$row["DisplayName"]] = $row["Value"] ;
					$url = $row["Value"];
			}		
								
		//=============================			
		if(isset($_POST['hdReturnURL']))
		{				
			$returnURL = $_POST["hdReturnURL"];
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
		
		$billmodel->refnumber = (new DateTime()) -> getTimestamp();					
		$billmodel->integrationfields = $merFields;	
		$paramsfields = array(		
			'ReturnURL' => $returnURL,
			'MerchantName' => $merName,
			//'URL' => $url,
			//'access_key' => $merFields["access_key"],
			//'profile_id' => $merFields["profile_id"],
			'transaction_uuid' => uniqid(),			
			'unsigned_field_names' => '',
			'signed_date_time' => gmdate("Y-m-d\TH:i:s\Z"),
			'locale' => 'en',
			'transaction_type' => 'authorization',
			'reference_number' => $billmodel->refnumber,
			'amount' => $billmodel->amount,
			'currency' => $billmodel->currency,
			'bill_to_forename' => $billmodel->firstname,
			'bill_to_surname' => $billmodel->lastname,
			'bill_to_address_line1' => $billmodel->address1,
			'bill_to_address_line2' => $billmodel->address2,
			'bill_to_address_city' => $billmodel->city,
			'bill_to_address_country' => $billmodel->country,
			'bill_to_address_postal_code' => $billmodel->zipcode,
			'bill_to_email' => $billmodel->email,
			'signed_field_names' => 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,bill_to_forename,bill_to_surname,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_country,bill_to_address_postal_code,bill_to_email',			
		);	
		
		foreach($merFields as $key => $value){			
			if($key != "SECRET_KEY")
				$paramsfields[$key] = $value;
		}
		
		//session_start();
		$_SESSION['SECRET_KEY'] = $merFields["SECRET_KEY"];				
		$billmodel->signature = $this->sign($paramsfields, $merFields["SECRET_KEY"]);				
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
				(FirstName, LastName, AddressLine1, AddressLine2, City, Country, ZipCode, State, Company, Email, Phone, TrxnDate)
				values (:FirstName, :LastName, :AddressLine1, :AddressLine2, :City, :Country, :ZipCode, :State, :Company, :Email, :Phone, :TrxnDate)";
		
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
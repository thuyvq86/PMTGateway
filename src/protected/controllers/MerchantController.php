<?php

class MerchantController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	protected function beforeAction($action)
	{
		if(Yii::app() -> user -> isGuest)
		{
			$url = $this -> createUrl("site/login");
			$this -> redirect($url);
			return false;
		}
		
		return true;
	}
	
	public function actionReport()
	{
		$fromDate = new DateTime();
		$toDate = new DateTime();
		if (isset($_POST["fromDate"]) && isset($_POST["toDate"]))
		{
			$fromDate = date_create_from_format("d/m/Y", $_POST["fromDate"]);
			$toDate = date_create_from_format("d/m/Y", $_POST["toDate"]);
		}
		
		$model = new ReportForm;
		$model->fromDate = $fromDate->format("Y,m,d");
		$model->toDate = $toDate->format("Y,m,d");
		
		$sqlStatement = 'select a.MerchantName, a.ReferenceNumber, a.RespCode, a.TrxnDateTime, b.Amount, b.Currency from cp_requestlog a inner join cp_epaybillinfo b on a.ReferenceNumber = b.ReferenceNumber where a.TrxnDateTime between :fromDate and :toDate';
		$connection = Yii::app() -> db;
		$connection -> active = true;
		$command = $connection -> createCommand($sqlStatement);
		$command -> bindValue(":fromDate", $fromDate->format("Y-m-d 00:00:00"));
		$command -> bindValue(":toDate", $toDate->format("Y-m-d 23:59:59"));
		$reader = $command -> query();
		$connection -> active = false;
		
		$model->aaData = '[';
		foreach($reader as $row) 
		{
			$model->aaData .= '{"col1": "' . $row["MerchantName"] . '","col2": "' . $row["ReferenceNumber"] . '","col3": "' . $row["Amount"] . '","col4": "' . $row["Currency"] . '","col5": "' . $row["RespCode"] . '","col6": "' . date_format(date_create($row["TrxnDateTime"]), 'd-m-Y H:i:s') . '"},';
		}
		if (strlen($model->aaData) > 1) $model->aaData = substr($model->aaData, 0, strlen($model->aaData) - 1);
		$model->aaData .= ']';
		
		$model->aoColumns = '[
					{ "sTitle": "Merchant Name", "mData": "col1" },
					{ "sTitle": "Reference Number", "mData": "col2" },
					{ "sTitle": "Amount", "mData": "col3" },
					{ "sTitle": "Currency", "mData": "col4" },
					{ "sTitle": "Response Code", "mData": "col5" },
					{ "sTitle": "Transaction Date", "mData": "col6" }
				]';
		
		$this->render('report',array('model'=>$model));
	}
	
	public function actionIndex()
	{
		$model = new MerchantForm();
		$model -> merchant = $this -> loadMerchant();
		
		if(isset($_POST["MerchantForm"]))
		{
			$model -> merchantId = $_POST["MerchantForm"]["merchantId"];
		}
		else if(count($model -> merchant) > 0)
		{
			$key = array_keys($model -> merchant);
			$model -> merchantId = $key[0];			
		}
		
		if(isset($model -> merchantId))
		{
			$data = $this -> loadMerchantInfo($model -> merchantId);
			$model -> merchantCode = $data["merchantCode"];
			$model -> merchantName = $data["merchantName"];			
			$model -> description = $data["description"];
		}
		
		$this->render('index', array("model" => $model));
	}
	
	public function actionUpdate()
	{
		if(isset($_POST["merchantId"]) && isset($_POST["MerchantForm"]))
		{			
			$merchantId = $_POST["merchantId"];
			$data = $_POST["MerchantForm"];
			$data = $this -> saveMerchant($merchantId, $data);
			
			$model = new MerchantForm();
			$model -> merchant = $this -> loadMerchant();
			$model -> merchantId = $data["merchantId"];
			$model -> merchantCode = $data["merchantCode"];
			$model -> merchantName = $data["merchantName"];			
			$model -> description = $data["description"];
			
			if($merchantId == 0)
				$model -> message = "Create Merchant successful.";
			else
				$model -> message = "Update Merchant successful.";
				
			$this->render('index', array("model" => $model));
		}
		else
		{
			$url = $this -> createUrl("merchant/index");
			$this -> redirect($url);
		}		
	}
	
	// Merchant Configuration
	public function actionConfig()
	{				
		$model = new ConfigForm;
		$model -> merchant = $this -> loadMerchant();
		
		if(isset($_POST["ConfigForm"]))
		{
			$data = $_POST["ConfigForm"];
			$model -> merchantId = $data["merchantId"];
		}
		else if(count($model -> merchant) > 0)
		{
			$key = array_keys($model -> merchant);
			$model -> merchantId = $key[0];
		}
		
		if(isset($model -> merchantId))
		{
			$model -> merchantName = $model -> merchant[$model -> merchantId];
			$model -> field = $this -> loadField($model -> merchantId);
		}
		
		$this->render('config', array("model" => $model));
	}
	
	public function actionSave()
	{
		if(isset($_POST["field"]) && isset($_POST["merchantId"]))
		{
			$model = new ConfigForm;
			$model -> merchant = $this -> loadMerchant();
				
			$model -> merchantId = $_POST["merchantId"];
			$model -> merchantName = $model -> merchant[$model -> merchantId];
			
			// Call save
			$field = $_POST["field"];
			$model -> field = $this -> saveField($model -> merchantId, $field);
			$model -> message = 'Save configuration successful.';
						
			$this->render('config', array("model" => $model));
		}
		else
		{
			$url = $this -> createUrl("merchant/config");
			$this -> redirect($url);
		}
	}
	
	private function loadMerchantInfo($merchantId)
	{
		$merchant = array();
		$connection = Yii::app() -> db;
		$connection -> active = true;		
		$sql = 'select ID, ProviderCode, ProviderName, IsActive, Description from CP_IntegrationProfile where ID = :merchantId';
		$command = $connection -> createCommand($sql);
		$command -> bindParam(":merchantId", $merchantId, PDO::PARAM_INT);
		$data = $command -> query();
		$connection -> active = false;
		
		foreach($data as $row)
		{			
			$merchant = array(
				'merchantId' => $row["ID"],
				'merchantCode' => trim($row["ProviderCode"]),
				'merchantName'=> trim($row["ProviderName"]),				
				'description' => $row["Description"]
			);
		}
		return $merchant;
	}
	
	private function saveMerchant($merchantId, $field)
	{
		$connection = Yii::app() -> db;
		$connection -> active = true;		
		$command = "";
				
		if($merchantId == 0)
		{
			$sql = "insert into cp_integrationprofile (ProviderCode, ProviderName, IsActive, Description, CreatedDate, CreatedBy)
					values (:ProviderCode, :ProviderName, 1, :Description, :Date, :User)";
			$command = $connection -> createCommand($sql);
		}
		else
		{
			$sql = "update cp_integrationprofile 
					set ProviderCode = :ProviderCode, ProviderName = :ProviderName, Description = :Description, ModifiedDate = :Date, ModifiedBy = :User
					where ID = :ID";			
			$command = $connection -> createCommand($sql);
			$command -> bindParam(":ID", $merchantId, PDO::PARAM_INT);
		}
		
		$user = Yii::app() -> user -> name;
		$today = date("Y-m-d H:i:s");
		$merchantCode = trim($field["merchantCode"]);
		$merchantName = trim($field["merchantName"]);
		$description = trim($field["description"]);		
		$command -> bindParam(":ProviderCode", $merchantCode, PDO::PARAM_STR);
		$command -> bindParam(":ProviderName", $merchantName, PDO::PARAM_STR);
		$command -> bindParam(":Description", $description, PDO::PARAM_STR);
		$command -> bindParam(":Date", $today, PDO::PARAM_STR);
		$command -> bindParam(":User", $user, PDO::PARAM_STR);
		$command -> execute();
		
		// Re-select		
		if($merchantId == 0)
		{
			$sql = "select ID, ProviderCode, ProviderName, Description from cp_integrationprofile where ID = LAST_INSERT_ID()";
			$command = $connection -> createCommand($sql);
		}
		else
		{
			$sql = "select ID, ProviderCode, ProviderName, Description from cp_integrationprofile where ID = :ID";
			$command = $connection -> createCommand($sql);
			$command -> bindParam(":ID", $merchantId, PDO::PARAM_INT);
		}
		$data = $command -> query();
		$connection -> active = false;
		
		$merchant = array();
		foreach($data as $row)
		{			
			$merchant = array(
				'merchantId' => $row["ID"],
				'merchantCode' => trim($row["ProviderCode"]),
				'merchantName'=> trim($row["ProviderName"]),				
				'description' => $row["Description"]
			);
		}
		return $merchant;
	}
	
	// Load All Merchant is Actived
	private function loadMerchant()
	{
		$merchant = array();
		
		$connection = Yii::app() -> db;
		$connection -> active = true;		
		$sql = 'select ID, ProviderCode, ProviderName from CP_IntegrationProfile where IsActive = 1';
		$command = $connection -> createCommand($sql);
		$data = $command -> query();
		$connection -> active = false;
		
		foreach($data as $row)
		{
			$display = trim($row["ProviderName"]) . "(" . trim($row["ProviderCode"]) . ")";
			$value = $row["ID"];			
			$merchant[$value] = $display;
		}			

		return $merchant;
	}
	
	private function loadField($profileId)
	{
		$field = array();		
		
		$connection = Yii::app() -> db;
		$connection -> active = true;		
		$sql = "select DisplayName, Value from CP_IntegrationFields where ProfileId = :profileId";
		$command = $connection -> createCommand($sql);
		$command -> bindParam(":profileId", $profileId, PDO::PARAM_INT);
		$data = $command -> query();
		$connection -> active = false;
		
		foreach($data as $row)
		{
			$name = trim($row["DisplayName"]);
			$value = trim($row["Value"]);
			$field[] = array("name" => $name, "value" => $value);
		}		
		
		return $field;
	}
	
	private function saveField($profileId, $field)
	{		
		$connection = Yii::app() -> db;
		$connection -> active = true;
		
		// Delete all old field of merchant
		$sql = "delete from CP_IntegrationFields where ProfileID = :profileId";
		$command = $connection -> createCommand($sql);
		$command -> bindParam(":profileId", $profileId, PDO::PARAM_INT);
		$command -> execute();
		
		// Insert new
		$result = array();
		$user = Yii::app() -> user -> name;
		$today = date("Y-m-d H:i:s");
		$sql = "insert into CP_IntegrationFields (ProfileID, IsActive, IsRequired, DisplayName, Value, CreatedBy, CreatedDate) values (:profileId, 1, 1, :name, :value, :user, :date)";
		$command = $connection -> createCommand($sql);
		$command -> bindParam(":profileId", $profileId, PDO::PARAM_INT);
		$command -> bindParam(":user", $user, PDO::PARAM_STR);
		$command -> bindParam(":date", $today, PDO::PARAM_STR);
		foreach($field as $key => $item)
		{
			$name = trim($item["name"]);
			$value = trim($item["value"]);
			$command -> bindParam(":name", $name, PDO::PARAM_STR);
			$command -> bindParam(":value", $value, PDO::PARAM_STR);
			$command -> execute();
			
			$result[] = array("name" => $name, "value" => $value);
		}
		$connection -> active = false;
		
		return $result;
	}
}
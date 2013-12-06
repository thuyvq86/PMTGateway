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

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{				
		$model = new MerchantForm;
		$model -> merchant = $this -> loadMerchant();
		
		// Load default Merchant, merchant at index 0
		if(count($model -> merchant) > 0)
		{
			$key = array_keys($model -> merchant);
			$model -> merchantId = $key[0];
			$model -> merchantName = $model -> merchant[$model -> merchantId];
			$model -> field = $this -> loadField($model -> merchantId);
		}
		
		$this->render('index', array("model" => $model));
	}
	
	public function actionLoad()
	{
		if(isset($_POST["MerchantForm"])) // Load Merchant
		{
			$model = new MerchantForm;
			$model -> merchant = $this -> loadMerchant();
			
			$data = $_POST["MerchantForm"];
			$model -> merchantId = $data["merchantId"];
			$model -> merchantName = $model -> merchant[$model -> merchantId];
			$model -> field = $this -> loadField($model -> merchantId);
			
			$this -> render('index', array("model" => $model));
		}
		else
		{
			$url = $this -> createUrl("merchant/index");
			$this -> redirect($url);
		}
	}
	
	public function actionSave()
	{
		if(isset($_POST["field"]) && isset($_POST["merchantId"]))
		{
			$model = new MerchantForm;
			$model -> merchant = $this -> loadMerchant();
		
			$field = $_POST["field"];			
			$model -> merchantId = $_POST["merchantId"];
			$model -> merchantName = $model -> merchant[$model -> merchantId];

			// Call save
			$model -> field = $this -> saveField($model -> merchantId, $field);
			
			$this->render('index', array("model" => $model));
		}
		else
		{
			$url = $this -> createUrl("merchant/index");
			$this -> redirect($url);
		}
	}
	
	// Load All Merchant is Actived
	private function loadMerchant()
	{
		$merchant = array();
		
		if(isset($_SESSION["merchant"]))
		{
			$merchant = $_SESSION["merchant"];
		}
		else
		{
			$connection = Yii::app() -> db;
			$connection -> active = true;		
			$sql = 'select ID, ProviderCode, ProviderName from PMTGateway.CP_IntegrationProfile where IsActive = 1';
			$command = $connection -> createCommand($sql);
			$data = $command -> query();
			foreach($data as $row)
			{
				$display = trim($row["ProviderName"]) . "(" . trim($row["ProviderCode"]) . ")";
				$value = $row["ID"];			
				$merchant[$value] = $display;
			}			
			$connection -> active = false;
			
			$_SESSION["merchant"] = $merchant;
		}
		
		return $merchant;
	}
	
	private function loadField($profileId)
	{
		$field = array();		
		
		$connection = Yii::app() -> db;
		$connection -> active = true;		
		$sql = "select DisplayName, Value from PMTGateway.CP_IntegrationFields where ProfileId = :profileId";
		$command = $connection -> createCommand($sql);
		$command -> bindParam(":profileId", $profileId, PDO::PARAM_INT);
		$data = $command -> query();
		foreach($data as $row)
		{
			$name = trim($row["DisplayName"]);
			$value = trim($row["Value"]);
			$field[] = array("name" => $name, "value" => $value);
		}		
		$connection -> active = false;
		
		return $field;
	}
	
	private function saveField($profileId, $field)
	{		
		$connection = Yii::app() -> db;
		$connection -> active = true;
		
		// Delete all old field of merchant
		$sql = "delete from PMTGateway.CP_IntegrationFields where ProfileID = :profileId";
		$command = $connection -> createCommand($sql);
		$command -> bindParam(":profileId", $profileId, PDO::PARAM_INT);
		$command -> execute();
		
		// Insert new
		$result = array();
		$user = Yii::app() -> user -> name;
		$today = date("Y-m-d H:i:s");
		$sql = "insert into PMTGateway.CP_IntegrationFields (ProfileID, IsActive, IsRequired, DisplayName, Value, CreatedBy, CreatedDate) values (:profileId, 1, 1, :name, :value, :user, :date)";
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
	
	public function actionReport()
	{
		$model = new ReportForm;
		
		$sqlStatement = 'select * from cp_requestlog';
		$connection = Yii::app() -> db;
		$connection -> active = true;
		$command = $connection -> createCommand($sqlStatement);
		$reader = $command -> query();
		$connection -> active = false;
		
		$model->aaData = '[';
		foreach($reader as $row) 
		{
		$model->aaData .= '{"col1": "' . $row["MerchantName"] . '","col2": "' . $row["ReferenceNumber"] . '","col3": "' . $row["RequestBody"] . '","col4": "' . $row["ResponseBody"] . '","col5": "' . $row["RespCode"] . '","col6": "' . date_format(date_create($row["TrxnDateTime"]), 'd-m-Y H:i:s') . '"},';
		}
		$model->aaData = substr($model->aaData, 0, strlen($model->aaData) - 1);
		$model->aaData .= ']';
		
		$model->aoColumns = '[
					{ "sTitle": "Merchant Name",   "mData": "col1" },
					{ "sTitle": "Reference Number",  "mData": "col2" },
					{ "sTitle": "Request Body", "mData": "col3" },
					{ "sTitle": "Response Body",  "mData": "col4" },
					{ "sTitle": "Response Code",    "mData": "col5" },
					{ "sTitle": "Transaction Date",    "mData": "col6" }
				]';
		
		$this->render('report',array('model'=>$model));
	}
}
<?php

class TrxnMonitoringController extends Controller
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
	
	public function addCache($bill)
		{			
			$key = 'monitor';
			$cache = Yii::app() -> cache -> get($key);
			if($cache == false)
			{
				$cache = new MonitorForm();				
			}
			
			$cache -> append($bill);
			Yii::app() -> cache -> set($key, $cache, 0);
		}
	
	
		
	public function actionView()
	{
		
		
		
		$model = new ViewForm;
		$sqlStatement = 'SELECT * FROM cp_epaybillinfo ORDER BY id DESC LIMIT 0 , 200';
		$connection = Yii::app() -> db;
		$connection -> active = true;
		$command = $connection -> createCommand($sqlStatement);
		$reader = $command -> query();
		$connection -> active = false;
		
		foreach($reader as $row)
		{
			$bill = new CacheForm();				
			$bill -> firstname =  $row["FirstName"];
			$bill -> lastname = $row["LastName"] ;               
			$bill -> company = $row["Company"];
			$bill -> address1 = $row["AddressLine1"];
			$bill -> address2 = $row["AddressLine2"];			
			$bill -> email = $row["Email"];
			$bill -> phone = $row["Phone"] ;    
			//$bill -> refnumber = $row["Refnumber"];
			//$bill -> amount = $row["Amount"];
			//$bill -> currency = $row["Currency"];
			
			$model-> setData($bill);
		}
	
		
		$this->render('view',array('model' => $model));
	}
}

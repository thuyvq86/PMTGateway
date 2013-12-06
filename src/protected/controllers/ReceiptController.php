<?php

class ReceiptController extends Controller
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
		
	
	public function actionRecept()
	{					
		$response = "";		
		foreach($_REQUEST as $name => $value) 
		{
				 $params[$name] = $value;                     
				 $output = "<input  type=\"text\" name=\"" . $name . "\" size=\"50\" value=\"" . $value . "\" readonly=\"true\"/><br/>";
				$response .= $output;
		}
									 
		$connection = Yii::app() -> db;
		$connection -> active = true;
	
		$sql = "UPDATE cp_requestlog SET RespCode = :RespCode, ResponseBody = :ResponseBody WHERE ReferenceNumber = :ReferenceNumber";						
		$res_refnumber = $params["req_reference_number"];		
		echo $res_refnumber;
		
		$respbody = $response;
		$respcode = "00";
		
		$command = $connection -> createCommand($sql);
		$command -> bindParam(":RespCode", $respcode, PDO::PARAM_STR);		
		$command -> bindParam(":ResponseBody", $respbody , PDO::PARAM_STR);
		$command -> bindParam(":ReferenceNumber", $res_refnumber, PDO::PARAM_STR);				
		$command -> execute();
		$connection -> active = false;		
		
		$this->render('Receipt',array('data' => $params));						
	}
		
}

<html>
<head>
    <title>Secure Acceptance - API Payment Form Example</title>
    <link rel="stylesheet" type="text/css" href="payment.css"/>
</head>
<body>
 <?php				
				/*foreach($_REQUEST as $name => $value) {
                     $params[$name] = $value;
                     //echo "<span>" . $name . "</span><input visible =\"false\" type=\"text\" name=\"" . $name . "\" size=\"50\" value=\"" . $value . "\" readonly=\"true\"/><br/>";
                 }*/
 ?>	 
<fieldset id="response">
    <legend>Receipt</legend>
    <div>
		<?php 
			$form=$this->beginWidget('CActiveForm', array(
			'id'=>'receipt-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),'action' => $data["req_merchant_secure_data1"],
			)); 			
		?>
        
            <?php
				foreach($_REQUEST as $name => $value) {			  				 
				 $output = "<input style=\"display: none\" type=\"text\" name=\"" . $name . "\" size=\"50\" value=\"" . $value . "\" readonly=\"true\"/><br/>";				 
				 echo $output;
			}			
		//<script>document.getElementById('receipt-form').submit();</script>								
            ?>        
		<?php $this->endWidget(); ?>
		
    </div>
	<script>document.getElementById('receipt-form').submit();</script>	
</fieldset>


</body>
</html>

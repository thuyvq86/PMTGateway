

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	'BillPayment',
);
?>


<?php


?>

<div class="form">
	
<?php 		
	$tempurl = Yii::app()->request->baseUrl.'/index.php?r=BillPayment/Send';
	$form=$this->beginWidget('CActiveForm', array(
	'id'=>'bill-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),'action' => $tempurl,
	)); 
//'action' => $data["URL"]

foreach ($model->integrationfields as $key => $value)
{
	if($key != 'URL' && $key != 'SECRET_KEY')
	{
		echo("\n<input type=\"hidden\" name=\"$key\" value=\"$value\">");		
	}
}
//$_SESSION['SECRET_KEY'] = "DEF";
/*
echo "==============";
foreach($data as $key => $value)
{
	echo $key . ' - ' . $value . "<br>";
}*/
?>
	
	<input type="hidden" name="ReturnURL" value="<?php echo $data["ReturnURL"] ?>">
	<input type="hidden" name="merchant_name" value="<?php echo $data["MerchantName"] ?>">
	<input type="hidden" name="transaction_uuid" value="<?php echo $data["transaction_uuid"] ?>">
	<input type="hidden" name="transaction_type" value="authorization">
    <input type="hidden" name="signed_field_names"
           value="access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency">
    <input type="hidden" name="unsigned_field_names">
    <input type="hidden" name="signed_date_time" value="<?php echo $data["signed_date_time"]; ?>">
    <input type="hidden" name="locale" value="en">
	<input type="hidden" name="allow_payment_token_update" value = "false">
	
	<input type="hidden" name="reference_number" value="<?php echo $data["reference_number"]; ?>">
	<input type="hidden" name="amount" value="<?php echo $data["amount"]; ?>">
	<input type="hidden" name="currency" value="<?php echo $data["currency"] ?>">	
	<input type="hidden" name="signature" value="<?php echo $model->signature;?>">		
	<input type="hidden" name="bill_payment" value="false">		
	<table width ="50%">
		<tr>
			<td width = "10%">			
			First Name:
			</td>
			<td>
				<input type="text" id = "bill_to_forename" name="bill_to_forename" value="<?php echo $model->firstname;?>"><br>				
			</td>
		</tr>		
		<tr>
			<td>			
			Last Name:
			</td>
			<td>
				<input type="text" name="bill_to_surname" value="<?php echo $model->lastname;?>"><br>
			</td>
		</tr>
		<tr>
			<td>			
			Company:
			</td>
			<td>
				<input type="text" name="bill_to_company_name" value="<?php echo $model->company;?>"><br>
			</td>
		</tr>
		<tr>
			<td>			
			Phone:
			</td>
			<td>
				<input type="text" name="bill_to_phone" value="<?php echo $model->phone;?>"><br>
			</td>
		</tr>
		<tr>
			<td>			
			Email:
			</td>
			<td>
				<input type="text" name="bill_to_email" value="<?php echo $model->email;?>"><br>
			</td>
		</tr>
		<tr>
			<td>			
			Address Line 1:
			</td>
			<td>
				<input type="text" name="bill_to_address_line1" value="<?php echo $model->address1;?>"><br>
			</td>
		</tr>
		<tr>
			<td>			
			Address Line 2:
			</td>
			<td>
				<input type="text" name="bill_to_address_line2" value="<?php echo $model->address2;?>"><br>
			</td>
		</tr>
		<tr>
			<td>			
			Conuntry:
			</td>
			<td>
				<input type="text" name="bill_to_address_country" value="<?php echo $model->country;?>"><br>
			</td>
		</tr>		
		<tr>
			<td>			
			City:
			</td>
			<td>
				<input type="text" name="bill_to_address_city" value="<?php echo $model->city;?>"><br>
			</td>
		</tr>		
		<tr>
			<td>			
			Zip Code:
			</td>
			<td>
				<input type="text" name="bill_to_address_postal_code" value="<?php echo $model->zipcode;?>"><br>
			</td>
		</tr>		
		<tr>
			<td>			
			State:
			</td>
			<td>
				<input type="text" name="bill_to_address_state" value="<?php echo $model->state;?>"><br>
			</td>
		</tr>				
		<tr>
			<td>						
			</td>
			<td>
				<input type="submit" value = "submit">
			</td>
		</tr>		
	</table>		 		
<?php $this->endWidget(); ?>
</div><!-- form -->


<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' Bill Payment';

?>


<?php


?>
<h1>Bill Payment</h1>
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

/*foreach ($model->integrationfields as $key => $value)
{
	if($key != 'URL' && $key != 'SECRET_KEY')
	{
		echo("\n<input type=\"hidden\" name=\"$key\" value=\"$value\">");		
	}
}*/
//$_SESSION['SECRET_KEY'] = "DEF";
/*
echo "==============";
foreach($data as $key => $value)
{
	echo $key . ' - ' . $value . "<br>";
}*/
?>
	
	<input type="hidden" name="accesss_key" value="<?php echo $data["access_key"] ?>">
	<input type="hidden" name="profile_id" value="<?php echo $data["profile_id"] ?>">
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
	<table width ="100%" cellpadding="5" cellspacing="0">
		<col width="25%/><col width="25%/><col width="25%/><col width="*"/>
		<tr>
			<td align="right">			
			First Name *:
			</td>
			<td>
				<input type="text" class="control" id = "bill_to_forename" name="bill_to_forename" value="<?php echo $model->firstname;?>"><br>				
			</td>
			<td align="right">			
			Amount:
			</td>
			<td>
				<input type="text" class="control" disabled id = "amount" name="amount" value="<?php echo $data["amount"];?>"><br>				
			</td>
		</tr>		
		<tr>
			<td align="right">			
			Last Name *:
			</td>
			<td>
				<input type="text" class="control" name="bill_to_surname" value="<?php echo $model->lastname;?>"><br>
			</td>
			<td align="right">			
			Currency:
			</td>
			<td>
				<input type="text" class="control" disabled id = "currency" name="amount" value="<?php echo $data["currency"];?>"><br>				
			</td>
		</tr>
		<tr>
			<td align="right">			
			Address Line 1 *:
			</td>
			<td>
				<input type="text" class="control" name="bill_to_address_line1" value="<?php echo $model->address1;?>"><br>
			</td>
			<td>						
			</td>
			<td>
				<input type="submit" value = "Submit" class="buttonClass">
			</td>
		</tr>
		<tr>
			<td align="right">			
			Address Line 2 *:
			</td>
			<td>
				<input type="text" class="control" name="bill_to_address_line2" value="<?php echo $model->address2;?>"><br>
			</td>
						
		</tr>
		<tr>
			<td align="right">			
			City *:
			</td>
			<td>
				<input type="text" class="control" name="bill_to_address_city" value="<?php echo $model->city;?>"><br>
			</td>
		</tr>		
		<tr>
			<td align="right">			
			Country *:
			</td>
			<td>
				<input type="text" disabled class="control" name="bill_to_address_country" value="<?php echo $model->country;?>"><br>
			</td>
		</tr>	
		<tr>
			<td align="right">			
			Zip Code *:
			</td>
			<td>
				<input type="text" disabled class="control" name="bill_to_address_postal_code" value="<?php echo $model->zipcode;?>"><br>
			</td>
		</tr>		
		<tr>
			<td align="right">			
			State:
			</td>
			<td>
				<input type="text" disabled class="control" name="bill_to_address_state" value="<?php echo $model->state;?>"><br>
			</td>
		</tr>				
		<tr>
			<td align="right">			
			Email:
			</td>
			<td>
				<input type="text" class="control" name="bill_to_email" value="<?php echo $model->email;?>"><br>
			</td>
		</tr>
		<tr>			
			<td align="right">			
			Company:
			</td>
			<td>
				<input type="text" class="control" name="bill_to_company_name" value="<?php echo $model->company;?>"><br>
			</td>
		</tr>
		<tr>
			<td align="right">			
			Phone *:
			</td>
			<td>
				<input type="text" class="control" name="bill_to_phone" value="<?php echo $model->phone;?>"><br>
			</td>
		</tr>
							
	</table>		 		
<?php $this->endWidget(); ?>
</div><!-- form -->
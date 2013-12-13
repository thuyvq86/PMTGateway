

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


/*
echo "==============";
foreach($data as $key => $value)
{
	echo $key . ' - ' . $value . "<br>";	
}
<input type="hidden" name="allow_payment_token_update" value = "false">		
<input type="hidden" name="amount" value="<?php echo $data["amount"]; ?>">
	<input type="hidden" name="currency" value="<?php echo $data["currency"] ?>">	
	<input type="hidden" name="REQUIRE_FIEDS[access_key]" value="<?php echo $data["access_key"] ?>">
	<input type="hidden" name="REQUIRE_FIEDS[profile_id]" value="<?php echo $data["profile_id"] ?>">	
	<input type="hidden" name="REQUIRE_FIEDS[transaction_uuid]" value="<?php echo $data["transaction_uuid"] ?>">
	<input type="hidden" name="REQUIRE_FIEDS[transaction_type]" value="<?php echo $data["transaction_type"] ?>">
    <input type="hidden" name="REQUIRE_FIEDS[signed_field_names]" value="<?php echo $data["signed_field_names"] ?>">
    <input type="hidden" name="REQUIRE_FIEDS[unsigned_field_names]" value="<?php echo $data["unsigned_field_names"] ?>">
    <input type="hidden" name="REQUIRE_FIEDS[signed_date_time]" value="<?php echo $data["signed_date_time"]; ?>">
    <input type="hidden" name="REQUIRE_FIEDS[locale]" value="<?php echo $data["locale"]; ?>">	
	<input type="hidden" name="REQUIRE_FIEDS[reference_number]" value="<?php echo $data["reference_number"]; ?>">		
	<input type="hidden" name="REQUIRE_FIEDS[merchant_secure_data1]" value="<?php echo $data["merchant_secure_data1"];?>">	
*/
?>	
	<input type="hidden" name="ReturnURL" value="<?php echo $model->returnURL; ?>">
	<input type="hidden" name="merchant_name" value="<?php echo $model->merchantname;  ?>">
	<input type="hidden" name="bill_payment" value="false">
	
	<?php 
		foreach($data as $key => $value){
			echo "<input type=\"hidden\" name=\"REQUIRE_FIEDS[". $key . "]\" value=\"" . $value . "\">" . "\n";
		}
	
	?>
	
	<table width ="100%" cellpadding="5" cellspacing="0">
		<col width="25%"/><col width="25%"/><col width="25%"/><col width="*"/>
		<tr>
			<td align="center"></td>
			<td align="left"><h1>Billing Information</h1></td>		
			<td colspan = "0" align="center"></td>
			<td align="left"><h1>Your Order</h1></td>
		</tr>
		<tr>
			<td align="right">			
			First Name *:
			</td>
			<td>								
					<input type="text" class="control" tabindex ="1" autocomplete="off"  name = "BILLS[bill_to_forename]" value="<?php echo $model->firstname;?>"><br>								
			</td>
			<td align="right">			
			Amount:
			</td>
			<td>
				<input type="text" class="control" tabindex ="13" autocomplete="off" readonly="true" name = "BILLS[amount]" value="<?php echo $model->amount;?>"><br>				
			</td>
		</tr>		
		<tr>
			<td align="right">			
			Last Name *:
			</td>
			<td>
				<input type="text" class="control" tabindex ="2" autocomplete="off" name="BILLS[bill_to_surname]" value="<?php echo $model->lastname;?>"><br>
			</td>
			<td align="right">			
			
			</td>
			<td>
				<input type="submit" tabindex ="14" value = "Submit" class="buttonClass">
			</td>
		</tr>
		<tr>
			<td align="right">			
			Address Line 1 *:
			</td>
			<td>
				<input type="text" class="control" tabindex ="3" autocomplete="off" name="BILLS[bill_to_address_line1]" value="<?php echo $model->address1;?>"><br>
			</td>
			<td>						
			</td>
			<td>				
				<input type="text" class="control" autocomplete="off" readonly="true" style="display:none" name = "BILLS[currency]" value="<?php echo $model->currency;;?>"><br>				
			</td>
		</tr>
		<tr>
			<td align="right">			
			Address Line 2 *:
			</td>
			<td>
				<input type="text" class="control" tabindex ="4" autocomplete="off" name="BILLS[bill_to_address_line2]" value="<?php echo $model->address2;?>"><br>
			</td>
						
		</tr>
		<tr>
			<td align="right">			
			City *:
			</td>
			<td>
				<input type="text" class="control" tabindex ="5" autocomplete="off" name="BILLS[bill_to_address_city]" value="<?php echo $model->city;?>"><br>
			</td>
		</tr>		
		<tr>
			<td align="right">			
			Country *:
			</td>
			<td>
				<input type="text"  class="control" tabindex ="6" autocomplete="off" readonly="true" name="BILLS[bill_to_address_country]" value="<?php echo $model->country;?>"><br>
			</td>
		</tr>	
		<tr>
			<td align="right">			
			Zip Code *:
			</td>
			<td>
				<input type="text" class="control" tabindex ="7" autocomplete="off" readonly="true" name="BILLS[bill_to_address_postal_code]" value="<?php echo $model->zipcode;?>"><br>
			</td>
		</tr>		
		<tr>
			<td align="right">			
			State:
			</td>
			<td>
				<input type="text" class="control" tabindex ="8" autocomplete="off" readonly="true" name="BILLS[bill_to_address_state]" value="<?php echo $model->state;?>"><br>
			</td>
		</tr>				
		<tr>
			<td align="right">			
			Email:
			</td>
			<td>
				<input type="text" class="control" tabindex ="9" autocomplete="off" name="BILLS[bill_to_email]" value="<?php echo $model->email;?>"><br>
			</td>
		</tr>
		<tr>			
			<td align="right">			
			Company:
			</td>
			<td>
				<input type="text" class="control" tabindex ="10" autocomplete="off" name="BILLS[bill_to_company_name]" value="<?php echo $model->company;?>"><br>
			</td>
		</tr>
		<tr>
			<td align="right">			
			Phone *:
			</td>
			<td>
				<input type="text" class="control" tabindex ="12" autocomplete="off" name="BILLS[bill_to_phone]" value="<?php echo $model->phone;?>"><br>
			</td>
		</tr>
							
	</table>		 		
<?php $this->endWidget(); ?>
</div><!-- form -->
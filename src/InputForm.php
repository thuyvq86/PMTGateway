
<div class="form">
	<?php 
	

		?>
	<form id="idInputForm" action = "http://localhost:8765/PMTGateway/index.php?r=BillPayment/BillPayment" method = "post">	
	<input type="hidden" name = "hdReturnURL" value = "http://localhost:8765/PMTGateway/InputForm.php">
	<input type="hidden" name = "provider_code" value = "MEpay">
	<input type="text" name="bill_to_forename" value="Hieu">
	<input type="text" name="bill_to_surname" value="Phan Trung">
	<input type="text" name="bill_to_company_name" value="Sacom">
	<input type="text" name="bill_to_phone" value="0938681718">
	<input type="text" name="bill_to_email" value="trunghieu1718@gmail.com">
	<input type="text" name="bill_to_address_line1" value="266-268">
	<input type="text" name="bill_to_address_line2" value="NKKN Q3">
	<input type="text" name="bill_to_address_country" value="VN">
	<input type="text" name="bill_to_address_city" value="HCM">	
	<input type="text" name="bill_to_address_postal_code" value="123456">
	<input type="text" name="bill_to_address_state" value="">
	<input type="text" name="amount" value="101">
	<input type="text" name="currency" value="USD">
	<input type="submit" value = "submit">
	</form>
		  	 
</div><!-- form -->
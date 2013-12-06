<?php

/**
 * ReportForm class.
 * ReportForm is the data structure for keeping
 * report form data. It is used by the 'report' action of 'MerchantController'.
 */
class ViewForm extends CFormModel
{
	public $aaData = '';
	public $aoColumns = '
	[
		{ "sTitle": "Customer Name", "mData": "col1" },
		{ "sTitle": "Company", "mData": "col2" },
		{ "sTitle": "Address", "mData": "col3" },
		{ "sTitle": "Email", "mData": "col4" },
		{ "sTitle": "Phone", "mData": "col5" },
		{ "sTitle": "Refnumber", "mData": "col6" },
		{ "sTitle": "Amount", "mData": "col7" },
		{ "sTitle": "Currency", "mData": "col8" }
	]';
	
	public function setData($data)
	{
		$json = '
		{
			"col1": "' . $data -> firstname . ' ' . $data -> lastname . '",
			"col2": "' . $data -> company . '",
			"col3": "' . $data -> address1 . ' ' . $data -> address2 . '",		
			"col4": "' . $data -> email . '",
			"col5": "' . $data -> phone . '",
			"col6": "' . $data -> refnumber . '",		
			"col7": "' . $data -> amount . '",			
			"col8": "' . $data -> currency . '"			
		}';
		
		if($this -> aaData == "")
		{
			$this -> aaData = $json;
		}
		else
		{
			$this -> aaData .= ', ' . $json;
		}
	}
	
	public function getData()
	{
		return '['. $this -> aaData .']';
	}
}

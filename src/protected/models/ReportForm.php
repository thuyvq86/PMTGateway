<?php

/**
 * ReportForm class.
 * ReportForm is the data structure for keeping
 * report form data. It is used by the 'report' action of 'MerchantController'.
 */
class ReportForm extends CFormModel
{
	public $fromDate;
	public $toDate;
	public $aaData;
	public $aoColumns;
}
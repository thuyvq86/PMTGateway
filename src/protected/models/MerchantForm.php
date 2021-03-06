<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class MerchantForm extends CFormModel
{
	public $merchantId;
	public $merchantCode;
	public $merchantName;
	public $isActive;
	public $description;
	public $merchant = array();
	public $message = "";
}

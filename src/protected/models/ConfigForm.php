<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ConfigForm extends CFormModel
{
	public $merchantId;
	public $merchantName;
	public $merchant = array();
	public $field = array();
	public $message = "";
}

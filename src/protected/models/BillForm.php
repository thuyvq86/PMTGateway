<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class BillForm extends CFormModel
{	
	public $firstname;
	public $lastname;	
	public $company;
	public $address1;
	public $address2;
	public $city;
	public $country;
	public $zipcode;
	public $state;
	public $email;
	public $phone;	
	public $refnumber;
	public $amount;
	public $currency;	
	public $signature;
	public $returnURL;
	public $merchantname;	
	public $invoiceid;
}

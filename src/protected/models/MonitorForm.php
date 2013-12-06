<?php

class MonitorForm
{	
	private $max = 200;
	private $input = 0;
	private $reader = 0;
	public $monitor = array();
	
	public function append($bill)
	{
		$this -> monitor[$this -> input] = $this -> createCacheItem($bill);
		
		$this -> input++;
		if($this -> input > $this -> max)
		{
			$this -> input = 0;
		}
	}
	
	public function getReader()
	{
		$result = $this -> reader;
		
		if(isset($this -> monitor[$result]))
		{
			$this -> reader++;
			if($this -> reader > $this -> max)
			{
				$this -> reader = 0;
			}
		
			return $result;
		}
		else
		{
			return -1;
		}
	}
	
	private function createCacheItem($bill)
	{
		// create cache item
		$item = new CacheForm();
		$item -> firstname = $bill -> firstname;
		$item -> lastname = $bill ->lastname;
		$item -> company = $bill -> company;
		$item -> address1 = $bill -> address1;
		$item -> address2 = $bill -> address2;
		$item -> city = $bill -> city;
		$item -> country = $bill -> country;
		$item -> zipcode = $bill -> zipcode;
		$item -> state = $bill -> state;
		$item -> email = $bill -> email;
		$item -> phone = $bill -> phone;
		$item -> refnumber = $bill -> refnumber;
		$item -> amount = $bill -> amount;
		$item -> currency = $bill -> currency;
		
		return $item;
	}
}

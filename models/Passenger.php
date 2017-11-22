<?php

class Passenger
{
	private $firstname;
	private $lastname;
	private $age;
	
	public function __construct(string $firstname = null, string $lastname = null, int $age = null)
	{
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->age = $age;
	}
	
	//setters and getters
	
	public function set_firstname($firstname)
	{
		$this->firstname = $firstname;
	}
	
	public function set_lastname($lastname)
	{
		$this->lastname = $lastname;
	}
	
	public function set_age($age)
	{
		$this->age = $age;
	}
	
	public function get_firstname()
	{
		return $this->firstname;
	}
	
	public function get_lastname()
	{
		return $this->lastname;
	}
	
	public function get_age()
	{
		return $this->age;
	}
}
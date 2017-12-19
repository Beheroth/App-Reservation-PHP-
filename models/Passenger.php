<?php

class Passenger
{
	private $firstname;
	private $lastname;
	private $age;
	private $reservation;
	
	public function __construct($firstname = null, $lastname = null, $age = null)
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

	/*
	public function get_reservation()
	{
		return $this->reservation;
	}
	
	public function set_reservation($reservation)
	{
		$this->reservation = reservation;
	}	
	*/
	
	//MySQLi
	
	public function save($id_res)
	{
		$mysqli = new mysqli("localhost", "root", "", "dbreservation") or die("Could not select database");
		if ($mysqli->connect_errno){
			var_dump( "FAILED to connect to MySQLi : (".$mysqli->connect_errno.")".$mysqli->connect_errno);
		}
		$sql = "INSERT INTO passenger (firstname, lastname, age, FK_reservation) VALUES ('".$this->firstname."','".$this->lastname."','".$this->get_age()."','".$id_res."')";
		if ($mysqli->query($sql) === TRUE){
			echo "Passenger successfully saved";
		} else {
			echo "Error creating passenger: " . $mysqli->error;
		}
		$mysqli->close();
	}
}
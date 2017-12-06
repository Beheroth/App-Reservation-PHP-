<?php
class Reservation
{
	private $id;
	private $destination;
	private $insurance = false;
	private $passengers = array();
	private $n_passengers = 1;
	
	private static $ADULT_PRICE = 15;
	private static $CHILD_PRICE = 12;
	
	public function __construct(int $id = null, string $destination = null, bool $insurance = null)
	{
		$this->id = $id;
		$this->destination = $destination;
		$this->insurance = $insurance; 
	}
	
	
	//setter and getter
	
	public function set_id_travel(int $id)
    {
        $this->id = $id;
    }
	
	public function get_id()
	{
		return $this->id;
	}
	
	public function set_destination(string $destination)
    {
        $this->destination = $destination;
    }
	
    public function get_destination()
    {
        return $this->destination;
    }
	
	public function set_insurance($insurance)
	{
		$this->insurance = $insurance;
	}
	
	public function get_insurance()
	{
		return $this->insurance;
	}
	
	public function set_n_passengers($n)
	{
		$this->n_passengers = $n;
	}
	
	public function get_n_passengers()
	{
		return $this->n_passengers;
	}
	
	public function add_passenger(Passenger $passenger)
	{
		$this->passengers[] = $passenger;
	}
	
	public function get_passengers()
	{
		return $this->passengers;
	}
	
	//MySQL 
	
	public function save()
	{
		$mysqli = new mysqli("localhost", "username", "password", "oui") or die("Could not select database");
		if (mysqli->connect_errno){
			echo "FAILED to connect to MySQLi : (".$mysqli->connect_errno.")".$mysqli->connect_errno;
		}
		$sql = "INSERT INTO reservations($ID, $Destination, $Assurance, $Prix)
		VALUES (".$this->get_ID().",".$this->get_destination().",".$this->get_assurance().",".$this->get_price()."); ";
		if ($mysqli->query($sql) === TRUE){
			echo "Record Updated successfully";
			$id_insert = $mysqli->insert_id;
		}else {
			echo "Error inserting record: " . $mysqli->error;
		}
	//functions
	
	public function get_n()
	{
		return count($this->passengers);
	}
	
	public static function list_reservations()
    {
        return array();
    }	
	
	public function get_price()
	{
		$total = 0;
		foreach($this->passengers as &$pas){
			if($pas->get_age() <= 11)
			{
				$total += 15;
			} else{
				$total += 10;
			}
		}
		return $total;
	}		
}

	
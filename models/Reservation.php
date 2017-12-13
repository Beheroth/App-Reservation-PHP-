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
	
	public function get_id()
	{
		return $this->id;
	}
	
	public function set_id($id)
	{
		$this->id = $id;
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
		$mysqli = new mysqli("localhost", "root", "", "dbreservation") or die("Could not select database");
		if ($mysqli->connect_errno){
			var_dump( "FAILED to connect to MySQLi : (".$mysqli->connect_errno.")".$mysqli->connect_errno);
		}
		$sql = "INSERT INTO reservations (Destination, Assurance, Prix) 
		VALUES ('".$this->destination."','".$this->insurance."','".$this->get_price()."')";
		if ($mysqli->query($sql) === TRUE){
			$id_res = $mysqli->insert_id;
			echo "Record Updated successfully".$id_res;
			$this->set_id($id_res);
		} else {
			echo "Error inserting record: " . $mysqli->error;
		}
		$mysqli->close();
		
		foreach($this->passengers as &$pas){
			$pas->save($this->get_id());
		}
	}
	
	public static function SQL_reservations()
	{
		echo "FONCTION SQL_reservation appelée";
		$sql_reservations = array();
		$mysqli = new mysqli('localhost', "root", "", "dbreservation") or die('Could not select database');
		if ($mysqli->connect_errno){
			var_dump( "FAILED to connect to MySQLi : (".$mysqli->connect_errno.")".$mysqli->connect_errno);
		}
		echo "AVANT LE IF STmT";
		if($stmt = $mysqli->prepare("SELECT * FROM dbreservation")) //http://php.net/manual/en/mysqli.prepare.php
		{
			$stmt->execute();
			$stmt->bind_result($PKreservation, $Destination, $Assurance, $Prix);
			echo "AVANT le WHILE";
			while ($stmt->fetch()){
				echo "FETCHEE";
				$sql_reservations[] = ["PKreservation" => $PKreservation,
				"Destination" => $Destination, "Assurance" => $Assurance, "Prix" => $Prix];
			}
			$stmt->close();
		} else{} #error couldn't prepare from dbreservation

		$mysqli->close();
		return $sql_reservations;
	}
	
	//functions
	
	public function get_n()
	{
		return count($this->passengers);
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

	
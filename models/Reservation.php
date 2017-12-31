<?php
class Reservation
{
	private $id;
	private $destination;
	private $insurance;
	private $passengers = array();
	private $n_passengers = 1;
	
	private static $ADULT_PRICE = 15;
	private static $CHILD_PRICE = 12;
	
	public function __construct($id = null, $destination = null, $insurance = null)
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
	
	public function set_destination($destination)
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
		//Connection to db
		$sql_reservations = array();
		$mysqli = new mysqli('localhost', "root", "", "dbreservation") or die('Could not select database');
		
		if ($mysqli->connect_errno){
			var_dump( "FAILED to connect to MySQLi : (".$mysqli->connect_errno.")".$mysqli->connect_errno);
		}
		
			//Query
		/*
		$stmt = "SELECT PKreservation, Destination, Assurance, Prix FROM reservations";
		$result = $mysqli->query($stmt);
		
			//Query error
		if(!$result) {die(mysqli_error()."\n");}
		var_dump($result);
		$result->bind_result($PKreservation, $Destination, $Assurance, $Prix);
		
		while ($row = $result->fetch_assoc()){
				$sql_reservations[] = ["PKreservation" => $PKreservation,
				"Destination" => $Destination, "Assurance" => $Assurance, "Prix" => $Prix];
			}
		$result->close();		
		*/
		

		if ($stmt = $mysqli->prepare("SELECT * FROM reservations")) //http://php.net/manual/en/mysqli.prepare.php
		{
			$stmt->execute();
			$stmt->bind_result($PKreservation, $Destination, $Assurance, $Prix);
			while ($stmt->fetch()){
				$sql_reservations[] = ["PKreservation" => $PKreservation, "Prix" => $Prix,
				"Destination" => $Destination, "Assurance" => $Assurance];
			}
			$stmt->close();
		}		
		$mysqli->close();
		return $sql_reservations;
	}
	
	public static function get_from_PK($PK)
	{
		$sql_reservations = array();
		$mysqli = new mysqli('localhost', "root", "", "dbreservation") or die('Could not select database');
		
		if ($mysqli->connect_errno){
			var_dump( "FAILED to connect to MySQLi : (".$mysqli->connect_errno.")".$mysqli->connect_errno);
		}
		
		if ($stmt = $mysqli->prepare("SELECT * FROM reservations WHERE PKreservation = ?"))
		{
			$stmt->bind_param('i', $PK);
			$stmt->execute();
			$stmt->bind_result($PKreservation, $Destination, $Assurance, $Prix);
			$stmt->fetch();
			$stmt->close();
			$res = new self($PKreservation, $Destination, $Assurance);
		}
		if ($stmt = $mysqli->prepare("SELECT * FROM passengers WHERE FK_reservation = ?")) 
		{
			$stmt->bind_param('i', $PK);
			$stmt->execute();
			$stmt->bind_result($ID, $Firstname, $Lastname, $Age, $FKres);
			while($stmt->fetch())
				{
					$pas = new Passenger($ID, $Firstname, $Lastname, $Age);
					$res->add_passenger($pas);
				}
			$stmt->close();		
		}		
		$mysqli->close();
		return $res;
	}
	
	public static function remove($PK)
	{
		$sql_reservations = array();
		$mysqli = new mysqli('localhost', "root", "", "dbreservation") or die('Could not select database');
		
		if ($mysqli->connect_errno){
			var_dump( "FAILED to connect to MySQLi : (".$mysqli->connect_errno.")".$mysqli->connect_errno);
		}
		
		if ($stmt = $mysqli->prepare("DELETE FROM passenger WHERE FK_reservation = ?")) 
		{
			$stmt->bind_param('i', $PK);
			$stmt->execute();
			$stmt->close();		
		}
		
		if ($stmt = $mysqli->prepare("DELETE FROM reservations WHERE PKreservation = ?"))
		{
			$stmt->bind_param('i', $PK);
			$stmt->execute();
			$stmt->close();
		}
		
		$mysqli->close();
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
				$total += 12;
			} else{
				$total += 15;
			}
		}
		if($this->get_insurance() != 0){
			$total += 20;
		}
		return $total;
	}		
}

	
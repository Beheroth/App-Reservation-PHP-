<?php
class Reservation
{
	private $id;
	private $destination;
	private $insurance = false;
	private $passengers = array();
	private $n_passengers = 1;
	
	
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
		array_push($this->passengers[], $passenger);
	}
	
	public function get_passengers()
	{
		return $this->passengers;
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
}

	
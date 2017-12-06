<?php

class App
{
	public function route()
	{
		include_once 'models/Reservation.php';
		include_once 'models/Passenger.php';
		if (isset($_POST['new'])) {
            $this->newR();
		} elseif (isset($_POST['stage1'])) {
            $this->stage1();
        } elseif (isset($_POST['stage2'])) {
            $this->stage2();
        } else {
			$this->home();
		}
	}
	
	private function home()
	{
		include'views/mainpage.php';
	}
	
	private function newR()
	{
		include'views/reservation-form.php';
	}
	
	private function stage1()
	{
		var_dump($_POST);
		$res = new Reservation();
		
		if (empty($_POST['destination'])) {
			//error
		} else {
			$res->set_destination($_POST['destination']);
		}
		
		if (empty($_POST['places'])){
			//error, please enter number of seats to reserve
		} elseif ($_POST['places'] < 1){
			//error, you must at least select one seat
		} elseif (is_numeric($_POST['places'])){
			$res->set_n_passengers((int)$_POST['places']);	
		}

		if (isset($_POST['insurance'])){
			$res->set_insurance(true);
		}
		
		$_SESSION['res'] = serialize($res);
		include'views/registration-form.php';
	}
	
	private function stage2()
	{
		var_dump($_POST);
		var_dump($_SESSION);
		
		if(isset($_SESSION['res'])){
			$res = unserialize($_SESSION['res']);		
			$pas = new Passenger();
		
			if(isset($_POST['lastname'])){
				$pas->set_lastname(filter_var($_POST['lastname'], FILTER_SANITIZE_STRIPPED));
			} else {
				//error no lastname
			}
		
			if(isset($_POST['firstname'])){
				$pas->set_firstname(filter_var($_POST['firstname'], FILTER_SANITIZE_STRIPPED));
			} else {
				//error no firstname
			}
			
			if(empty($_POST['age'])){
				//error no age
			} elseif ($_POST['age'] < 0){
				//error invalid age
			} elseif (is_numeric($_POST['age'])) {
				$age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
				$pas->set_age((int) $age);
			}
			
			$res->add_passenger($pas);
			$_SESSION['res'] = serialize($res);
			if(count($res->get_passengers()) == $res->get_n_passengers()){
				include'views/payment-form.php';
			} elseif(count($res->get_passengers()) <= $res->get_n_passengers()) {
				include'views/registration-form.php';
			}
		} else {
			//error no reservation objet
		}
	}
	
}
		
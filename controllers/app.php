<?php

class App
{
	public function route()
	{
		include_once 'models/Reservation.php';
		include_once 'models/Passenger.php';
		
		if (isset($_POST['new'])) {
            $this->newR();
		} elseif (isset($_POST['reserve'])) {
            $this->reserve();
        } elseif (isset($_POST['register'])) {
            $this->register();
		} elseif (isset($_POST['finish'])) {
			$this->finish();
		} elseif (isset($_POST['modify'])) {
			$PK = $_POST['modify'];
			$res = Reservation::get_from_PK($PK);
			$_SESSION['res'] = serialize($res);
			$this->newR();
		} elseif (isset($_POST['remove'])) {
			$PK = $_POST['remove'];
			Reservation::remove($PK);
			$this->home();
        } else {
			$this->home();
		}
	}
	
	private function home()
	{
		session_unset();
		include'views/mainpage.php';
	}
	
	private function newR()
	{
		if(isset($_SESSION['res']))
		{
			$res = unserialize($_SESSION['res']);
		} else {
			$res = null;
		}
		
		if(isset($_SESSION['error_flags']))
		{
			$error_flags = unserialize($_SESSION['error_flags']);
		} else {
			$error_flags = array();
		}
		
		include'views/reservation-form.php';
	}
	
	private function reserve()
	{				
		$res = new Reservation();
		if(isset($_SESSION['res']))
		{
			$res = unserialize($_SESSION['res']);
		}
		
		$error_flags = array();
		
		if (empty($_POST['destination'])) {
			$error_flags[] = "Veuillez entrer une destination";
		} else {
			$res->set_destination($_POST['destination']);
		}
		
		if (empty($_POST['places'])){
			$error_flags[] = "Veuillez indiquer le nombre de places souhaitées";
		} elseif ($_POST['places'] < 1){
			$error_flags[] = "Veuillez choisir au moins 1 place";
		} elseif (is_numeric($_POST['places'])){
			$res->set_n_passengers((int)$_POST['places']);	
		} else {
			$error_flags[] = "Veuillez sélectionner un nombre valide de places (au moins 1)";
		}
		
		$insurance = "0";
		if(isset($_POST['insurance'])){
			$insurance = "1";
		}
		$res->set_insurance($insurance);
		
		$_SESSION['res'] = serialize($res);
		$_SESSION['error_flags'] = serialize($error_flags);
		
		if(count($error_flags) == 0){
			include'views/registration-form.php';
		} else {
			$this->newR();
		}
	}
	
	private function register()
	{	
	
		if(isset($_SESSION['res'])){
			$res = unserialize($_SESSION['res']);
			
			$error_flags = array();
			
			$pas = new Passenger();
		
			if(empty($_POST['lastname'])){
				$error_flags[] = "Veuillez entrer une nom";
			} else {
				$pas->set_lastname(filter_var($_POST['lastname'], FILTER_SANITIZE_STRIPPED));
			}
		
			if(empty($_POST['firstname'])){
				$error_flags[] = "Veuillez entrer un prénom";
			} else {
				$pas->set_firstname(filter_var($_POST['firstname'], FILTER_SANITIZE_STRIPPED));
			}
			
			if(empty($_POST['age'])){
				$error_flags[] = "Veuillez entrer un age";
			} elseif (!is_numeric($_POST['age'])){
				$error_flags[] = "Veuillez entrer un nombre";
			} elseif ($_POST['age'] < 0){
				$error_flags[] = "L'age doit etre plus grand que 0";
			} elseif (is_numeric($_POST['age'])) {
				$age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
				$pas->set_age((int) $age);
			}
			$_SESSION['error_flags'] = serialize($error_flags);
			
			if(count($error_flags) == 0){
				$res->add_passenger($pas);
				$_SESSION['res'] = serialize($res);
			}
			
			include'views/registration-form.php';
			
		} else {
			$this->reserve();
		}
	}
	
	private function finish()
	{
		if(isset($_SESSION['res']))
		{
			$finish_error = array();
			$_SESSION['finsih_error'] = serialize($finish_error);
			$res = unserialize($_SESSION['res']);
			if($res->get_n() < 1){
				$finish_error[] = "Veuillez enregistrer au moins 1 passager";
				$_SESSION['finish_error'] = serialize($finish_error);
				include'views/registration-form.php';
			} else {
				$res->save();
				$this->home();
			}
			echo("Reservation effectuée et sauvée sur la database");
		}
		
	}
}
		
<?php

class App
{
	public function route()
	{
		include_once 'models/Reservation.php';
		
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
		include'views/registration-form.php';
	}
	
	private function stage2()
	{
		include'views/payment-form.php';
	}
}
		
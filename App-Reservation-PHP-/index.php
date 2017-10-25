<?php
	session_start();
	include_once 'controllers/app.php';
	$app = new App();
	$app->route();
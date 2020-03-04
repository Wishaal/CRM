<?php
	
	require_once('php/config/app.php');
	$username = $_SESSION['app']['user']['username'];
	unset($_SESSION['app']);
	unset($_SESSION['user']);
	unset($_SESSION['username']);
	unset($_SESSION['userName']);
	unset($_SESSION['timeout']);
	session_destroy();
	 
	header('location: ' . BASE_HREF . 'index.php');
	exit();
?>
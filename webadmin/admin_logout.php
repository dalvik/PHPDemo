<?php
	session_start();
	unset($_SESSION["shell"]);
	//$_SESSION["shell"] ="";
	//session_unset();
	session_destory();
	header('Location:login.php');
?>
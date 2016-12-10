<?php
if(!isset($_SESSION)){
	session_start();	
}
if(empty($_SESSION['shell'])){
	header('Location:login.php');
}
?>
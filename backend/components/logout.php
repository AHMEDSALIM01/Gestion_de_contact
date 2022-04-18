<?php
	session_start();
	if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
		header('location:login.php');
	}
	session_destroy();
	session_unset();

	header('location:../index.php');
?>
<?php
	require 'sql_connect.php';
	session_start();
	unset($_SESSION['user_id']);
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['signed_in']);
	mysqli_close($connect);
	header("Location:mainpage.php");
?>
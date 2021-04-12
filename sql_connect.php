<?php
	$host = "localhost";
	$username = "ado25";
	$password = "Student_4193339";
	$dbname = "ado25";
	$connect = mysqli_connect($host, $username, $password, $dbname);
	if(!$connect)
		{
			echo "Error: Failed to connect <br>" . mysqli_error($connect);
		}
?>
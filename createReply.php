<!DOCTYPE html>
<html lang="en">
<head>
	<title> Create Reply Forum</title>
	<?php
		include 'header-style.php';
		require 'sql_connect.php';

	?>
</head>
<body>
	<?php
		// if($_SERVER['REQUEST_METHOD'] != 'POST')
  //   	{ 
			echo '<form action="" id="topicform" method="POST"> 
				Comments: 
				<br>
				<textarea rows="20" cols="70" name="reply_msg">
				Enter text here...</textarea><br>
				<button type="submit" form="topicform" value="Submit">Submit</button>
				</form>';
			echo '<br><h3> PRESS THE TWEETER LOGO TO GO HOME </h3>';
		// }
		// else
		// {
			date_default_timezone_set("America/New_York");
			$rStamp = date("Y-d-m") ." ". date("h:i:s");
			$rMsg = $_POST['reply_msg'];
			$tID = $_SESSION['tid'];
			$uID = $_SESSION['user_id'];

	    	$sql2 = "INSERT INTO ado25.midterm_reply(m_reply_msg, m_topic_reply, m_user_reply, m_reply_timestamp) VALUES('$rMsg', '$tID' , '$uID' , '$rStamp')";
			$result2 = mysqli_query($connect, $sql2);
			if(!$result2)
	   		{
	       		echo "<br>";
	 			echo "Error: " . $sql2 . "<br>" . mysqli_error($connect);
	   		}
	   		else
	    	{
	     		echo 'New reply successfully added. Press The Tweeter Logo to go to the main page! Or reload the page to add another';
	    	}
		//}
	?>
</body>
<?php
	include 'footer-style.php';
?>
</html>
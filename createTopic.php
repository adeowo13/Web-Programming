<!DOCTYPE html>
<html lang="en">
<head>
	<title> Create Topic Forum</title>
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
					<label for="topic_name">Topic Name</label>
			  		<input type="text" name="top_name"><br><br>

				Comments: 
				<br>
				<textarea rows="20" cols="70" name="top_msg">
				Enter text here...</textarea><br>
				<button type="submit" form="topicform" value="Submit">Submit</button>
				</form>';
			echo '<br><h3> PRESS THE TWEETER LOGO TO GO HOME </h3>';
		// }
		// else
		// {
			date_default_timezone_set("America/New_York");
			$tStamp = date("Y-d-m") ." ". date("h:i:s");
			$tName = $_POST['top_name'];
			$tMsg = $_POST['top_msg'];
			$cID = $_SESSION['cid'];
			$uID = $_SESSION['user_id'];

			 $sql = "INSERT INTO ado25.midterm_topic(m_topic_name, m_topic_msg, m_timestamp, m_cat_topic, m_user_topic) VALUES ('$tName', '$tMsg', '$tStamp', '$cID' , '$uID')";
			 $result = mysqli_query($connect, $sql);
			 
			 if(!$result)
		    {
		       	echo "<br>";
		 		echo "Error: " . $sql . "<br>" . mysqli_error($connect);
		    }
		    else 
		    {
		    	$query = "SELECT LAST_INSERT_ID(m_topic_id) from ado25.midterm_topic order by m_topic_id DESC";
		    	$result = mysqli_query($connect, $query);
		    	$row = mysqli_fetch_array($result);
		    	$topicid = $row[0];


		    	$sql2 = "INSERT INTO ado25.midterm_reply(m_reply_msg, m_topic_reply, m_user_reply, m_reply_timestamp) VALUES('$tMsg', '$topicid' , '$uID' , '$tStamp');";
				$result2 = mysqli_query($connect, $sql2);
				if(!$result2)
		   		{
		       		echo "<br>";
		 			echo "Error: " . $sql . "<br>" . mysqli_error($connect);
		   		}
		   		else
		    	{
		     		echo 'New topic successfully added. Press The Tweeter Logo to go to the main page! Or reload the page to add another';
		    	}
			}
		// }
	?>
</body>
<?php
	include 'footer-style.php';
?>
</html>
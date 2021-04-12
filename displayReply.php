<!DOCTYPE html>
<html lang="en">
<head>
	<title> Display Reply Forum</title>
	<?php
		include 'header-style.php';
		require 'sql_connect.php';	
	?>
</head>
<body>
	<?php
		
		$temp = $_GET['tid'];
		$id = chop($temp, 'style =');
		$_SESSION['tid'] = $id;

		$sql = "SELECT m_reply_id, m_reply_msg, m_reply_timestamp, midterm_user.m_username, midterm_topic.m_topic_name FROM ado25.midterm_reply
		JOIN ado25.midterm_user ON  m_user_reply = m_user_id
		JOIN ado25.midterm_topic ON  m_topic_reply = m_topic_id
		WHERE m_topic_reply = ".$id." ORDER BY m_reply_timestamp ASC";

		$result = mysqli_query($connect, $sql);
		if (!mysqli_query($connect, $sql)) 
		{
  			echo "<br>";
		 	echo "Error: " . $sql . "<br>" . mysqli_error($connect);
		}
		else 
		{
			$get_top = mysqli_fetch_array($result);
			$top_name = $get_top['m_topic_name'];
			echo"<h3> Welcome to the `".$top_name."` Topic Page! </h3>";
			echo "<table width = 100% border = '1' cellspacing = '1' cellpadding = '1'>";
			echo "<tr><td>Messages (Newest Reply at Bottom)</td><td>Reply Creator</td><td>Date</td></tr>";

			$result = mysqli_query($connect, $sql);
			while($row = mysqli_fetch_array($result))
			{
				$rep_id = $row['m_reply_id'];
				echo "<tr>";
				echo "<td id=reply>";
					echo "<p>".$row['m_reply_msg']."</p>";  
				echo "</td>";
				echo "<td id= reply_creator>";
					echo  "<p>" .$row['m_username']. "</p>";
				echo "</td>";
				echo "<td id= reply_date>";
							echo  "<p>". $row['m_reply_timestamp']. "</p>"; 
						echo "</td>";
				echo "</tr>";
			}
		}
		if($_SESSION['signed_in'] == true)
		{
			echo '<form action="createReply.php" method="POST">
				<div class="button">
						<input type="submit" name = "button" value="Add New Reply">
				</div>
				</form>';
		}
	?>
</body>
<?php
	include 'footer-style.php';
?>
</html>

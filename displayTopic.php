<!DOCTYPE html>
<html lang="en">
<head>
	<title> Display Topic Forum</title>
	<?php
		include 'header-style.php';
		require 'sql_connect.php';	
	?>
</head>
<body>
	<?php
		
		$temp = $_GET['cid'];
		$id = chop($temp, 'style =');
		$_SESSION['cid'] = $id;

		$sql = "SELECT m_topic_id, m_topic_name, m_topic_msg, m_timestamp, midterm_user.m_username, midterm_category.m_category_name FROM ado25.midterm_topic
		JOIN ado25.midterm_user ON  m_user_topic = m_user_id
		JOIN ado25.midterm_category ON  m_cat_topic = m_category_id
		WHERE m_cat_topic = ".$id." ORDER BY m_timestamp";

		$result = mysqli_query($connect, $sql);
		if (!mysqli_query($connect, $sql)) 
		{
  			echo "<br>";
		 	echo "Error: " . $sql . "<br>" . mysqli_error($connect);
		}
		else 
		{
			$get_cat = mysqli_fetch_array($result);
			$cat_name = $get_cat['m_category_name'];
			echo"<h3> Welcome to the `".$cat_name."` Category Page! </h3>";
			echo "<table width = 100% border = '1' cellspacing = '1' cellpadding = '1'>";
			echo "<tr><td>Topics</td><td>Number of Replies</td><td>Topic Creator</td><td>Date</td></tr>";

			$result = mysqli_query($connect, $sql);
			while($row = mysqli_fetch_array($result))
			{
				$temp = $row['m_topic_id'];
				$sql2 = "SELECT COUNT(*) FROM ado25.midterm_reply WHERE m_topic_reply = '$temp'";
				$result2 = mysqli_query($connect, $sql2);
				if (!mysqli_query($connect, $sql2)) 
				{
  					echo "<br>";
		 			echo "Error: " . $sql . "<br>" . mysqli_error($connect);
				}
				$row2 = mysqli_fetch_array($result2);
				$top_id = $row['m_topic_id'];
				echo "<tr>";
				echo "<td id=topic>";
					echo "<a href = 'displayReply.php?tid=".$top_id."'>" .$row['m_topic_name']. "</a>";  
				echo "</td>";
				echo "<td id= num_reply>";
					echo  "<p>".$row2['COUNT(*)']."</p>"; 
				echo "</td>";
				echo "<td id= top_creator>";
					echo  "<p>" .$row['m_username']. "</p>";
				echo "</td>";
				echo "<td id= top_date>";
							echo  "<p>". $row['m_timestamp']. "</p>"; 
						echo "</td>";
				echo "</tr>";
			}
		}
		if($_SESSION['signed_in'] == true)
		{
			echo '<form action="createTopic.php" method="POST">
				<div class="button">
						<input type="submit" name = "button" value="Add New Topic">
				</div>
				</form>';
		}
	?>
</body>
<?php
	include 'footer-style.php';
?>
</html>
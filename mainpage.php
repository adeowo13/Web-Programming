<!DOCTYPE html>
<html lang="en">
<head>
	<title> Tweeter Forum </title>
	<?php
		include 'header-style.php';
		require 'sql_connect.php';
		$userErr = ""; $passErr = ""; $error = 0;

		if(isset($_SESSION['signed_in']))
		{
			if(strcmp($_SESSION['signed_in'], 'true') == 0)
			{ //1
				echo " HELLO, <h3>". $_SESSION['username']. "</h3> IF YOU WOULD LIKE TO LOG OUT PRESS <a href = 'logout.php'> HERE. </a>";
			} //1
		}
		else
		{ //2
			if($_SERVER['REQUEST_METHOD'] != 'POST')
			{ //3
				echo '<form action="" method="POST">
					<p>Name: <input type="text" id = userN name = "userN" placeholder = "Username"></p>
					<p>Password: <input type="password" id = pass name = "pass" placeholder = "Password"></p>
					<div class="button">
							<input type="submit" id=submit value="Submit">
					</div>
				</form>';
			} //3
			else
			{ //4
				if(empty($_POST['userN']))
				{ //5
					$userErr = "Username field must be filled! Please try again clicking the tweeter logo<br>";
					$error++;
				} //5
				if(empty($_POST['pass']))
				{ //6
					$passErr = "Password field must be filled! Please try again clicking the tweeter logo<br>";
					$error++;
				} //6
				if($error != 0)
				{ //7
					echo $userErr."<br>".$passErr."<br>";
				} //7 
				else
				{ //8
					$sql = "SELECT m_user_id, m_username, m_password from ado25.midterm_user WHERE m_username = '$_POST[userN]' AND m_password = '$_POST[pass]'";
					$result = mysqli_query($connect, $sql);
					if (!mysqli_query($connect, $sql)) 
					{ //9
			  			echo "<br>";
					 	echo "Error: " . $sql . "<br>" . mysqli_error($connect);
					} //9
					else 
					{ //10
						if(mysqli_num_rows($result) == 0)
						{ //11
							echo "This Username/Password Combination has not worked, please try again by clicking the tweeter logo";
						} //11
						else
						{ //12
							$_SESSION['signed_in'] = "true";
							while($row = mysqli_fetch_array($result)) 
							{ //13
								$_SESSION['user_id'] = $row['m_user_id'];
								$_SESSION['username'] = $row['m_username'];
								$_SESSION['password'] = $row['m_password'];
							} //13
							echo "THANK YOU! YOU ARE NOW SIGNED IN " .$_SESSION['username']. "! IF YOU WOULD LIKE TO LOG OUT PRESS <a href = 'logout.php'> HERE. </a>";  
						} //12
					} //10
				} //8 
			} //4
		} //2
	?>
</head>
<body>
	<?php
		echo "<table width = 100% border = '1' cellspacing = '1' cellpadding = '1'>";
		echo "<tr><td>Categories</td><td>Number of Topics</td></tr>";
		$sql = "SELECT * FROM ado25.midterm_category";
		

		$result = mysqli_query($connect, $sql);
		if (!mysqli_query($connect, $sql)) 
		{
  			echo "<br>";
		 	echo "Error: " . $sql . "<br>" . mysqli_error($connect);
		}
		else 
		{
			while($row = mysqli_fetch_array($result))
			{
				$temp = $row['m_category_id'];
				$sql2 = "SELECT COUNT(*) FROM ado25.midterm_topic WHERE m_cat_topic = '$temp'";
				$result2 = mysqli_query($connect, $sql2);
				if (!mysqli_query($connect, $sql)) 
				{
  					echo "<br>";
		 			echo "Error: " . $sql . "<br>" . mysqli_error($connect);
				}
				$row2 = mysqli_fetch_array($result2);
				$cat_id = $row['m_category_id'];

				echo "<tr>";
					echo "<td id=cat>";
						echo "<a href = 'displayTopic.php?cid=".$cat_id."'>" .$row['m_category_name']. "</a> <br> <p>" .$row['m_category_desc'].  "</p>";  
					echo "</td>";
					echo "<td id= num_top>";
						echo  $row2['COUNT(*)']; 
					echo "</td>";
				echo "</tr>";
			}
		}
	?>

</body>
<?php
	include 'footer-style.php';
?>
</html>

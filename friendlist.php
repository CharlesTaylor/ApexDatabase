<html>
<head>
	<title> APEX friend list page</title>
</head>
<body>

<?php
require_once("db_constants.php");
if (!isset($_POST['submit'])) {
	?>	<!-- The HTML registration form -->
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		Username: <input type="text" name="username" /><br />
		Password: <input type="password" name="password" /><br />
		Email: <input type="type" name="email" /><br />

		<input type="submit" name="submit" value="Login" />
	</form>
	<?php
} else {
## connect mysql server
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	# check connection
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}
## query database
	# prepare data for insertion
	$username	= $_POST['username'];
	$password	= $_POST['password'];
	$email	= $_POST['email'];

	# check if username and email exist else insert

	$result = $mysqli->query("SELECT user_id from USER WHERE username = '{$username}' and password = '{$password}' and email = '{$email}'");
	if ($result && $result->num_rows > 0) {
		$row = mysqli_fetch_row($result);
		$friendlist = $mysqli->query("SELECT friend_name from friendlist WHERE user_id = '{$row[0]}'");


		while ($row2 = mysqli_fetch_assoc($friendlist)) {
			printf ("\n%s\n", $row2["friend_name"]);
			$lastseen =  $mysqli->query("SELECT last_seen from user WHERE username = '{$row2["friend_name"]}'");

			if (($lastseen && $lastseen->num_rows > 0) ) {
				echo "<p> query calisiyor</p>";
				$value = mysqli_fetch_assoc($lastseen);
				$curtime = time();
				$timedif = $curtime - $value["last_seen"];
				if ($timedif > 60) {
					echo "<p>\n this user is offline\n</p>";
				}
				else {
					echo "<p>\n this user is online.</p>";
				}
				printf("last seen: %d", $value["last_seen"]);
			}
			else {
				echo "<p> query calismiyor</p>";
			}
		}


	} else {
		echo "<p>such user does not exist.</p>";
		exit();
	}

}
?>
</body>
</html>











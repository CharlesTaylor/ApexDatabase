<html>
<head>
	<title> APEX User Registration Page</title>
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
 
		<input type="submit" name="submit" value="Register" />
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
	$exists = 0;
	$result = $mysqli->query("SELECT username from USER WHERE username = '{$username}'");
	if ($result && $result->num_rows > 0) {
		$exists = 1;
		$result = $mysqli->query("SELECT email from USER WHERE email = '{$email}'");
		if ($result && $result->num_rows > 0) $exists = 2;	
	} else {
		$result = $mysqli->query("SELECT email from USER WHERE email = '{$email}'");
		if ($result && $result->num_rows > 0) $exists = 3;
	}
 
	if ($exists == 1) echo "<p>Username already exists!</p>";
	else if ($exists == 2) echo "<p>Username and Email already exists!</p>";
	else if ($exists == 3) echo "<p>Email already exists!</p>";
	else {
		# insert data into mysql database
		$t = time();
		$sql = "INSERT  INTO `USER` ( `username`, `password`, `email`,`last_seen`, `auth_date`) 
				VALUES ( '{$username}', '{$password}', '{$email}', '{$t}', '{$t}')";
 
		if ($mysqli->query($sql)) {
			//echo "New Record has id ".$mysqli->insert_id;
			echo "<p>Registred successfully!</p>";
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}
	}
}
?>		
</body>
</html>
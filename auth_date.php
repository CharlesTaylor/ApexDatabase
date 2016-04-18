<html>
<head>
	<title> APEX User auth date update</title>
</head>
<body>

<?php
require_once("db_constants.php");

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	# check connection
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}
## query database

##update timestamp of the user
	$result = $mysqli->query("SELECT * from USER ");
	$t = time();
	echo "time epoch: $t";
	if ($result->num_rows > 0) {
		$mysqli->query("UPDATE user SET auth_date='{$t}'");
		echo "<p> it works.</p>";
	}
	else {
		echo "<p>no user in db</p>";
	}
?>









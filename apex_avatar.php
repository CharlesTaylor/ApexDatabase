<html>
<head>
	<title> APEX User avatar addition</title>
</head>
<body>

<?php
require_once("db_constants.php");

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	# check connection
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}## query database

	##add the avatar of the user
	$username = "fatih";
	$result = $mysqli->query("SELECT user_id from USER  WHERE username = `{$username}`");
	$row = mysqli_fetch_row($result);
	$avatarname = "eve";
	$classname = "space pirate";
	
	$sql = "INSERT into `avatar` (`owner_id`, `avatar_name`, `class`) VALUES (''{$row[0]}', '{$avatarname}', '{$classname}')";
	if ($mysqli->query($sql)) {
		echo "<p>Avatar added successfully!</p>";
	} else {
		echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
		exit();
	}
?>


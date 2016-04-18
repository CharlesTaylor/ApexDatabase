<?php 
$link = mysqli_connect('localhost','apexuser','apexrules'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 
echo 'Connected to mysql server'; mysqli_close($link); 
?> 
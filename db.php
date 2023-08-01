<?php
define('db_server', 'localhost');
define('db_username', 'newuser');
define('db_passwd', 'ehdus3048');
define('db_name', 'db_raccoon');
$db = mysqli_connect(db_server, db_username, db_passwd, db_name);

if ($db === false)
	die("Error: connection error." . mysqli_connect_error());
?>
<!DOCTYPE html>
<?php session_start(); ?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" initial-scale=1.0">
	<meta http-equiv="Content-Security-Policy"content="default-src http://20.200.213.108:60002/src/">
	<title>raccoon</title>
</head>

<body bgcolor="PaleTurquoise">
	<?php
	if (!isset($_SESSION["userid"]) || $_SESSION["userid"] != true) { ?>
	<marquee> <h1>hello world!</h1> </marquee>
		<p style='color:red'>status: unauthenticated</p>
		<a href='login.php'>Sign in to access this site</a></br>
		<img src='./src/hi.jpg' width='700' alt='raccoon'>
	<?php } else {
		$username = $_SESSION['user']['username'];
		echo "<marquee> <h1>hello $username!</h1></marquee>"; ?>
		<p style='color:green'>status: authenticated</p>
		<a href='file.php' style='font-size:100px;'>FiLe DrIvE</a><br>
		<a href='forum/forum.php' style='font-size:100px;'>fOrUm</a><br>
		<a href='logout.php' style='font-size:100px;'>LoGoUt</a><br>
		<img src='./src/2.jpg' width='500' alt='raccoon'>
	<?php } ?>
</body>

</html>

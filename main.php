<!DOCTYPE html>
<?php
session_start();
?>

<html lang = "en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" initial-scale=1.0">
	<title>raccoon</title>
</head>
<body bgcolor="PaleTurquoise">
	<?php
	if (!isset($_SESSION["userid"]) || $_SESSION["userid"] != true) { ?>
		<h1>hello world!</h1>
		<p style='color:red'>status: unauthenticated</p>
		<a href='login.php'>Sign in to access this site</a></br>
		<img src='./src/hi.jpg' width = '700' alt='raccoon'>
	<?php }
	else{
		$username = $_SESSION['user']['username'];
		echo "<h1>hello $username!</h1>";?>
		<p style='color:green'>status: authenticated</p>
		<a href='forum/forum.php' style='font-size:100px;'>forum [NEW!!]</a><br>
		<a href='logout.php'>logout</a><br>
		<img src='./src/2.jpg' width = '500' alt='raccoon'>
		<?php } ?>
</body>
</html>

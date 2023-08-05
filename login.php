<!DOCTYPE html>
<?php
require_once "db.php";
require_once "session.php";

function redirect($url)
{
	header('Location: ' . $url);
	exit();
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	$uname = trim($_POST['uname']);
	$pw = trim($_POST['pw']);
	if (empty($uname))
		$error .= '<p style="color:red">Please enter your username.</p>';
	if (empty($pw))
		$error .= '<p style="color:red">Please enter your password.</p>';

	if (empty($error)) {
		if ($query = $db->prepare("SELECT * FROM users WHERE username = ?")) {
			$query->bind_param('s', $uname);
			$query->execute();
			$row = $query->get_result()->fetch_assoc();
			if ($row) {
				if (password_verify($pw, $row['password'])) {
					$_SESSION["userid"] = $row['id'];
					$_SESSION["user"] = $row;
					redirect("main.php");
				} else
					$error .= '<p style="color:red">The password is not valid.</p>';
			} else
				$error .= '<p style="color:red">Account does not exist.</p>';
		}
		$query->close();
	}
	mysqli_close($db);
}
?>

<form method="post">
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport">
		<title>login</title>
		<meta http-equiv="Content-Security-Policy" content="default-src 'none'">
	</head>

	<body>
		<h1>Login</h1>
		<form action="" method="post">
			<?php echo $error; ?>
			username: <input type="text" placeholder="Enter your username" name="uname" required></br>
			password: <input type="password" placeholder="Enter your password" name="pw" required></br>
			<input type="submit" name="submit" value="submit"></br>
			</br>New to this site? <a href="./register.php">Register here!</a></br>
			<a href="./">main</a></br>
		</form>
	</body>

	</html>
</form>

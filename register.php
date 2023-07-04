<?php
require_once "db.php";
require_once "session.php";

$error = '';
$success=0;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	$username = trim($_POST['username']);
	$pw = trim($_POST['password']);
	$con_pw = trim($_POST['con_password']);
	$pw_hash = password_hash($pw, PASSWORD_BCRYPT);

	if(strlen($pw) < 6)
		$error .= '<p style="color:red">Password must have atleast 6 characters!</p>';
	if(empty($con_pw))
		$error .= '<p>Please enter confirm password.</p>';
	else{
		if (empty($error) && ($pw != $con_pw))
			$error .= '<p>Password did not match.</p>';
	}

	if (empty($error)){
		  $stmt = $db->prepare("SELECT COUNT(*) AS count FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if($count > 0) 
            $error .= '<p style="color:red">The username already exists.</p>';
		  else {
			$insertSQL = $db->prepare("INSERT INTO users (username, password) VALUES(?, ?);");
			$insertSQL->bind_param("ss", $username, $pw_hash);
			$result = $insertSQL->execute();
			if ($result)
				$error .= '<p>Your registration was successful!</p>';
			else
				$error .= '<p>Something went wrong!</p>';
			$insertSQL->close();
		  }
			mysqli_close($db);
	}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset = "UTF-8">
			<meta name="viewport" content="width=device-width initial-scale=1.0">
			<title>register</title>
	</head>
	<body>
		<h1>Register</h1>
		<?php echo $error; ?>
		<form action="" method="post">
		User name <input type="text" name="username" placeholder="Enter a username" required></br>
		Password <input type="password" name="password" placeholder="Enter a password" required></br>
		Confirm Password <input type="password" name="con_password" placeholder="Enter a password" required>
		</br><input type="submit" name="submit" value="Register">
		<p>Already have an account? <a href="login.php">Login here</a></p>
		</form>
	</body>
</html>



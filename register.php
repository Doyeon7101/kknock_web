<?php
require_once "db.php";
require_once "session.php";

function isValidInput($input) {
	$pattern = '/^[a-zA-Z0-9:!\~\?]+$/';
	return preg_match($pattern, $input);
}

$error = '';
$success = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $pw = trim($_POST['password']);
    $con_pw = trim($_POST['con_password']);
    $pw_hash = password_hash($pw, PASSWORD_BCRYPT);

    if (strlen($pw) < 6 || strlen($username) < 6) {
        $error .= '<p style="color:red">ID/Password must have at least 6 characters!</p>';
    } else if (empty($con_pw)) {
        $error .= '<p>Please enter confirm password.</p>';
    } else if (strlen($username) > 50) {
        $error .= '<p>The username must be a maximum of 50 characters.</p>';
    } else if (strlen($username) > 255) {
        $error .= '<p>The password must be a maximum of 255 characters.</p>';
    } else if (empty($error) && ($pw != $con_pw)) {
        $error .= '<p>Password did not match.</p>';
    } else if (!isValidInput($username)) {
        $error .= '<p>Invalid input. Only lowercase/uppercase letters, numbers (0-9), and special characters (:, !, ~, ?) are allowed.</p>';
    }

    if (empty($error)) {
        $stmt = $db->prepare("SELECT COUNT(*) AS count FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $error .= '<p style="color:red">The username already exists.</p>';
        } else {
            $insertSQL = $db->prepare("INSERT INTO users (username, password) VALUES(?, ?);");
            $insertSQL->bind_param("ss", $username, $pw_hash);
            $result = $insertSQL->execute();
            if ($result) {
                $error .= '<p>Your registration was successful!</p>';
            } else {
                $error .= '<p>Something went wrong!</p>';
            }
            $insertSQL->close();
        }
        mysqli_close($db);
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0">
	<title>register</title>
	<meta http-equiv="Content-Security-Policy" content="default-src 'none'">
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

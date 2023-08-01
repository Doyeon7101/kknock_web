<!DOCTYPE html>
<?php
require_once "session_forum.php";
require_once "../db.php";

function print_error_exit($msg)
{
	echo '<script>';
	echo 'alert("' . $msg . '");';
	echo 'window.location.href = "post.php";';
	echo '</script>';
	exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	$title = $_POST['title'];
	$author_id = $_SESSION['userid'];
	$content = $_POST['content'];
	if ($_POST['mode'] === 'edit')
		$post_id = $_POST['id'];

	$error = '';
	if (strlen($title) < 1)
		$error .= 'Title must be longer than 1 character.';
	if (empty($content))
		$error .= "Content is required.";
	if (!empty($error))
		print_error_exit($error);

	$query = $_POST["mode"] === 'edit' ? "UPDATE post SET title=?, content=? WHERE id=?" : "INSERT INTO post (title, author_id, content) VALUES(?, ?, ?);";
	$insertSQL = $db->prepare($query);
	if ($_POST["mode"] === 'edit') {
		$insertSQL->bind_param("ssi", $title, $content, $post_id);
	} else {
		$insertSQL->bind_param("sss", $title, $author_id, $content);
	}
	$result = $insertSQL->execute();
	if (!$result)
		print_error_exit('Something went wrong!');
	$insertSQL->close();
	mysqli_close($db);
	header("location: forum.php");
	exit;
}
?>
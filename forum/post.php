<!DOCTYPE html>
<?php
require_once "../db.php";
require_once "session_forum.php";

function redirect($url)
{
	header('Location: ' . $url);
	exit();
}


if (!empty($_GET['id'])) {
	$id = $_GET['id'];
	$userid = $_SESSION['userid'];
	$query = "SELECT author_id, title, content FROM post WHERE id = $id";
	$result = mysqli_query($db, $query);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		if ($userid == $row['author_id']) {
			$title = $row['title'];
			$content = $row['content'];
		}
		else
			echo "<script>alert('Unauthorized user!'); window.location.href = 'forum.php';</script>";
	}
	else
		echo "<script>alert('Unauthorized user!'); window.location.href = 'forum.php';</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>
		<?php echo isset($title) ? "Edit" : 'Create'; ?>
	</title>
</head>

<body bgcolor="DarkSeaGreen">
	<h2>
		<?php echo isset($title) ? "Edit a post" : 'Create a post'; ?>
	</h2>
	<form action="process_post.php" method="POST">
		<input type="text" id="title" name="title" placeholder="Title" style="width:670px;height:20px"
			value="<?php echo isset($title) ? $title : ''; ?>" required><br><br>
		<textarea rows="60" cols="82" placeholder="Text" name="content"
			required><?php echo isset($content) ? $content : ''; ?></textarea><br>
		<input type="hidden" name="mode" value="<?php echo isset($title) ? 'edit' : 'new' ?>">
		<input type='hidden' name="id" value=<?php echo isset($title) ? $id : 0 ?>>
		<input type="submit" name='submit' value="post">
	</form>
</body>

</html>
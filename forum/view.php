<?php
require_once "session_forum.php";
require_once "db_forum.php";

$id = $_GET['id'];
if (empty($id)){
	 echo '<script>';
    echo 'alert("Error: Something went wrong!");';
    echo 'window.location.href = "../main.php";';
    echo '</script>';
    exit;
}

$query = "SELECT post.*, users.username FROM post JOIN users ON post.author_id = users.id WHERE post.id = $id";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
if (empty($row))
{
	echo "<script>alert('Error: The requested post does not exist.')</script>";
	echo '<script>window.location.href = "forum.php"; </script>';
	exit;
}

$query = "UPDATE post SET views = views + 1 WHERE id = $id";
$result = mysqli_query($db, $query);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Delete'])) {
	$error ='';
	if ($row['author_id'] != $_SESSION['user']['id'])
		echo "<script>alert('Unauthorized user!');</script>";
	else
	{
		$query = "DELETE FROM post WHERE id=$id";
		$result = mysqli_query($db, $query);
		echo '<script>alert("Post successfully deleted."); window.location.href = "forum.php";</script>';
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Edit'])) {
	echo '<script>window.location.href = "post.php?id=$id";</script>';
}

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $row['title']; ?></title>
</head>
<body bgcolor="DarkSeaGreen">
	<a href="../main.php">main</a>
	<a href="forum.php">forum</a>
	<h1><?php echo $row['title']; ?></h1>
	<h3>author: <?php echo $row['username']?></h3>
	<p>created at: <?php echo $row['created_at']?> / Hit: <?php echo $row['views']?></p>
	<hr />
	<textarea rows="60" cols="82" readonly><?php echo htmlspecialchars($row['content']);?></textarea><br>
	<?php if ($row['username'] === $_SESSION['user']['username']) { ?>
		<form action="" method="post">
		</br><input type="submit" name="Delete" value="Delete">
		<input type="submit" name="Edit" value="Edit">
		</form>
		<?php }?>
</body>
</html>

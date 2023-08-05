<?php
require_once "session_forum.php";
require_once "db_forum.php";

$comment_id = '';
$c_content = '';

$id = $_GET['id'];
if (empty($id)) {
	echo '<script>';
	echo 'alert("Error: Something went wrong!");';
	echo 'window.location.href = "../main.php";';
	echo '</script>';
	exit;
}

$query = "SELECT post.*, users.username FROM post JOIN users ON post.author_id = users.id WHERE post.id = $id";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
if (empty($row)) {
	echo "<script>alert('Error: The requested post does not exist.')</script>";
	echo '<script>window.location.href = "forum.php"; </script>';
	exit;
}
$title = $row['title'];
$author = $row['username'];
$created_at = $row['created_at'];
$views = $row['views'];
$p_author_id = $row['author_id'];
$p_content = $row['content'];

$query = "UPDATE post SET views = views + 1 WHERE id = $id";
$result = mysqli_query($db, $query);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['P_Delete'])) {
	$error = '';
	if ($row['author_id'] != $_SESSION['user']['id'])
		echo "<script>alert('Unauthorized user!');</script>";
	else {
		$query = "DELETE FROM comments WHERE post_id=$id";
		$result = mysqli_query($db, $query);

		$query = "DELETE FROM post WHERE id=$id";
		$result = mysqli_query($db, $query);
		echo '<script>alert("Post successfully deleted."); window.location.href = "forum.php";</script>';
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['P_Edit'])) {
	echo "<script>window.location.href = 'post.php?id=$id';</script>";
	exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['commentAdd'])) {
    $comment = $_POST['comment'];


    $author_id = $_SESSION['user']['id'];
    $post_id = $id;

	$query = ($_POST['mode'] === 'edit')
		? "UPDATE comments SET content = ? WHERE id = ? AND author_id = ?"
		: "INSERT INTO comments (author_id, post_id, content) VALUES (?, ?, ?)";
    $SQL= $db->prepare($query);

	if ($_POST['mode'] === 'edit')
		$SQL->bind_param("sii", $comment, $_SESSION['commentId'], $author_id);
	else 
		$SQL->bind_param("iis", $author_id, $post_id, $comment);

    $result = $SQL->execute();
    if ($result) {
        header("Location: view.php?id=$id");
        exit;
    }
	else 
        echo "Something went wrong with submitting the comment.";
    $SQL->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['C_delete'])) {
	$commentId = $_POST['comment_id'];
	$query = "DELETE FROM comments WHERE id = $commentId";
	$result = mysqli_query($db, $query);
	echo '<script>alert("comment successfully deleted."); window.location.href = "view.php?id=' . $id . '";</script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['C_edit'])) {
	$commentId = $_POST['comment_id']; // 댓글의 ID를 가져옴
	$c_query = "SELECT content, author_id FROM comments WHERE id = $commentId";
	$c_result = mysqli_query($db, $c_query);
	if ($c_result) {
		$c_row = mysqli_fetch_assoc($c_result);
		if ($_SESSION['userid'] == $c_row['author_id']) {
			$c_content = $c_row['content'];
			$_SESSION["commentId"] = $_POST['comment_id'];
		}
		else
			echo '<script>alert("Unauthorized access!"); window.location.href = "view.php?id=' . $id . '";</script>';

	}
	else
		echo '<script>alert("Unauthorized access!"); window.location.href = "view.php?id=' . $id . '";</script>';
}


function comment_db_prepare($db, $id) {
	$query = "SELECT comments.*, users.username
          FROM comments 
          JOIN users ON comments.author_id = users.id 
          WHERE comments.post_id = $id 
          ORDER BY comments.created_at DESC";

	$result = mysqli_query($db, $query);
	return $result;
}
$comment_result = comment_db_prepare($db, $id);
?>

<!DOCTYPE html>
<html>

<head>
	<title>
		<?php echo $title; ?>
	</title>
	<meta http-equiv="Content-Secureity-Policy"content="default-src 'none'">
</head>

<body bgcolor="DarkSeaGreen">
	<a href="../main.php">main</a>
	<a href="forum.php">forum</a>
	<h1>
		<?php echo htmlspecialchars($title);?>
	</h1>
	<h3>author:
		<?php echo htmlspecialchars($author);?>
	</h3>
	<p>created at:
		<?php echo $created_at ?>
		<?php echo $views ?>
	</p>
	<?php if ($p_author_id == $_SESSION['userid']) { ?>
		<form action="" method="post">
			<input type="submit" name="P_Delete" value="Delete">
			<input type="submit" name="P_Edit" value="Edit">
		</form>
	<?php } ?>
	<hr />
	<textarea rows="30" cols="82" readonly><?php echo htmlspecialchars($p_content); ?></textarea><br>
	<hr />
	<form action="" method="post">
		<h3>comment</h3>
		<textarea name="comment" rows="5" cols="82" requiired><?php echo htmlspecialchars($c_content); ?></textarea>
		<input type="hidden" name="mode" value="<?php echo empty($c_content) ? 'new' : 'edit'; ?>">
		<input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
		<input type="submit" name="commentAdd" value="+">

	</form>
	<?php
	if ($comment_result) {
		while ($c_row = mysqli_fetch_assoc($comment_result)) {
			echo "<p style='color:blue; font-size:20px;'>{";echo htmlspecialchars($c_row['username']); echo "}<br></p>";
			echo "created_at: {$c_row['created_at']}<br>";
			echo htmlspecialchars($c_row['content']);
			if ($c_row['author_id'] == $_SESSION['userid']) {
				echo "<form action='' method='post'>";
				echo "<input type='submit' name='C_edit' value='Edit'>";
				echo "<input type='submit' name='C_delete' value='Delete'>";
				echo "<input type='hidden' name='comment_id' value='{$c_row['id']}'>";
				echo "</form>";
			}
			echo "<hr>";
		}
	mysqli_free_result($comment_result);
	} ?>
</body>
</html>

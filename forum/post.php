<!DOCTYPE html>
<?php
require_once "../db.php";
require_once "session_forum.php";

function redirect($url){
	header('Location: ' . $url);
	exit();
}

/* $status = $_GET('status'); */
/* if ($status === 'edit'){ */
/* } */

?>

<!DOCTYPE html>
<html>
<head>
  <title>Create a post</title>
</head>
<body bgcolor="DarkSeaGreen">
	  <h2>Create a post</h2>
	  <form action="process_post.php" method="POST">
			<input type="text" id="title" name="title" placeholder="Title" style="width:670px;height:20px;" required ><br><br>
			<textarea rows="60" cols="82" placeholder="Text" name="content" required></textarea><br>
		 <input type="submit" name='submit' value="post">
	  </form>
</body>
</html>


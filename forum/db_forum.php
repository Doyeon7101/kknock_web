<?php
require_once "../db.php";

function getPostCount($db) {
	$query = 'SELECT COUNT(*) as count FROM post';
	$result = mysqli_query($db, $query);

	if ($result) {
		 $row = mysqli_fetch_assoc($result);
		 return $row['count'];
	}
	return 0;
}

$postCount = getPostCount($db);
?>

<?php
require_once "session_forum.php";
require_once "db_forum.php";

if (!isset($_COOKIE["short"])) {
    $_COOKIE["short"] = "latest";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['short'])) {
    $selectedOption = $_POST['short'];
    setcookie("short", $selectedOption, time() + 3600, "/");
    $_COOKIE["short"] = $selectedOption;
}

$list_num = 3;
$page_num = 2;
$page = isset($_GET['page']) ? $_GET['page'] : 1; // current page
$total_page = ceil($postCount / $list_num);
$total_block = ceil($total_page / $page_num);
$now_block = ceil($page / $page_num);
$s_pagenum = ($now_block - 1) * $page_num + 1;

if ($s_pagenum <= 0)
    $s_pagenum = 1;

$e_pagenum = $now_block * $page_num;

if ($e_pagenum > $total_page)
    $e_pagenum = $total_page;

$start = ($page - 1) * $list_num;

$searchKeyword = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $searchKeyword = trim($_POST['keyword']);
    // Store the search query in the session
    $_SESSION['search_query'] = $searchKeyword;
    // Redirect to the first page when a new search query is submitted
    header("Location: forum.php?page=1&keyword=$searchKeyword");
    exit;
} else {
    // If the user did not submit a search query, check if it exists in the session
    if (isset($_SESSION['search_query'])) {
        $searchKeyword = $_SESSION['search_query'];
    }
}

$orderBy = "";
$limit = "LIMIT ?, ?";
$param = "%$searchKeyword%";

if ($_COOKIE['short'] == 'MostComments') {
    $orderBy = "ORDER BY COUNT(comments.id) DESC";
} elseif ($_COOKIE['short'] == 'MostViews') {
    $orderBy = "ORDER BY post.views DESC";
} else {
    $orderBy = "ORDER BY post.created_at DESC";
}

$query = "SELECT post.*, users.username
          FROM post
          INNER JOIN users ON post.author_id = users.id
          LEFT JOIN comments ON comments.post_id = post.id
          WHERE post.title LIKE ?
          GROUP BY post.id
          $orderBy
          $limit;";

$stmt = $db->prepare($query);
$stmt->bind_param("sii", $param, $start, $list_num);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Forum</title>
	 <meta http-equiv="Content-Security-Policy" content="default-src http://20.200.213.108:60002/src/1.jpg">
</head>

<body bgcolor="DarkSeaGreen">
    <h1>Forum</h1>
    <img src='../src/1.jpg' width='200' alt='raccoon'>
    <form action="" method="post">
        <select name="short">
            <option value="Latest" <?php if ($_COOKIE['short'] === 'Latest') echo 'selected'; ?>>Latest</option>
            <option value="MostComments" <?php if ($_COOKIE['short'] === 'MostComments') echo 'selected'; ?>>Most Comments</option>
            <option value="MostViews" <?php if ($_COOKIE['short'] === 'MostViews') echo 'selected'; ?>>Most Views</option>
        </select>
        <button type="submit">Submit</button>
    </form>
    <form action="" method="post">
        <input type="text" name="keyword" placeholder="Search...">
        <button type="submit" name="search">Search</button>
    </form>
    <table border="7">
        <tr>
            <td width="50%" style="text-align:center">Title</td>
            <td width="20%" style="text-align:center">UserName</td>
            <td width="20%" style="text-align:center">CreatedAt</td>
            <td width="10%" style="text-align:center">Views</td>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td style="text-align:center"><a href="view.php?id=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['title']); ?></a></td>
                <td style="text-align:center">
                    <?php echo htmlspecialchars($row['username']); ?>
                </td>
                <td style="text-align:center">
                    <?php echo $row['created_at']; ?>
                </td>
                <td style="text-align:center">
                    <?php echo $row['views']; ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <p>
        <?php if ($page <= 1) { ?>
            <a href="forum.php?page=1<?php if (!empty($searchKeyword)) echo '&search=1&keyword=' . urlencode($searchKeyword); ?>">prev</a>
        <?php } else { ?>
            <a href="forum.php?page=<?php echo ($page - 1); ?><?php if (!empty($searchKeyword)) echo '&search=1&keyword=' . urlencode($searchKeyword); ?>">prev</a>
        <?php }; ?>

        <?php for ($print_page = $s_pagenum; $print_page <= $e_pagenum; $print_page++) { ?>
            <a href="forum.php?page=<?php echo $print_page; ?><?php if (!empty($searchKeyword)) echo '&search=1&keyword=' . urlencode($searchKeyword); ?>"><?php echo $print_page; ?></a>
        <?php }; ?>
        <?php if ($page >= $total_page) { ?>
            <a href="forum.php?page=<?php echo $total_page; ?><?php if (!empty($searchKeyword)) echo '&search=1&keyword=' . urlencode($searchKeyword); ?>">next</a>
        <?php } else { ?>
            <a href="forum.php?page=<?php echo ($page + 1); ?><?php if (!empty($searchKeyword)) echo '&search=1&keyword=' . urlencode($searchKeyword); ?>">next</a>
        <?php }; ?>
    </p>

    <a href="post.php">post</a>
    <a href="../main.php">main</a>
</body>

</html>


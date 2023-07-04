<?php
session_start();

if (!isset($_SESSION["userid"]) || $_SESSION["userid"] != true) {
	 echo '<script>';
    echo 'alert("Access Denied: Please log in to access this page.");';
    echo 'window.location.href = "../main.php";';
    echo '</script>';
    exit;
}

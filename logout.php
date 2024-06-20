<?php 
session_start();

if (!isset($_SESSION['unique_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && $_GET['id'] == $_SESSION['unique_id']) {
    session_unset();
    session_destroy();
    header("Location: login.php");
} else {
    header("Location: index.php");
}
exit();
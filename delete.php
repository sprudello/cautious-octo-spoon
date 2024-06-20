<?php 
    include_once "database/connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['delid'];
        $sql = mysqli_query($conn, "DELETE FROM passwords WHERE id = $id;");
    }

    header("Location:http://" . $_SERVER['HTTP_HOST']."/cautious-octo-spoon/");

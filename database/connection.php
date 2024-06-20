<?php
$conn = mysqli_connect("localhost", "root", "", "passwordmanager");

if (mysqli_connect_error()) {
    echo "<div class='db-message'>Connection Error.</div>";
} else {
    echo "<div class='db-message'>Database connected successfully.</div>";
}
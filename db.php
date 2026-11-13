<?php
// Database connection used by every page
$host = "localhost";
$user = "cat2user";
$pass = "Cat2Pass!2026";
$db   = "CAT2";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

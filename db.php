<?php
$host = "localhost";
$user = "root";
$pass = ""; // your MySQL password
$dbname = "evalanche";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

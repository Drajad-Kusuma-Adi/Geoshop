<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "geoshop";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    echo "<a href='../index.php'>Back to home</a>";
    die("Connection failed: " . $conn->connect_error);
}

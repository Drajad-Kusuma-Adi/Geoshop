<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $resetEmail = $_GET["resetEmail"];

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $value1);
    $value1 = $resetEmail;
    $stmt->execute();
    if ($stmt->errno) {
        header("Location: ../error.php");
        die();
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        header("Location: ../loginPage.php?reset=1");
    } else {
        header("Location: ../loginPage.php?invalid=2");
        die("Invalid data");
    }
}

$stmt->close();
$conn->close();

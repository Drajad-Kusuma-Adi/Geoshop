<?php
session_start();
require_once "config.php";

// Script to send message
$sql = "INSERT INTO chats (sender_id, target_id, content, datetime) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $value1, $value2, $value3, $value4);
$value1 = $_SESSION["userId"];
$value2 = $_GET["targetId"];
$value3 = $_POST["message"];
date_default_timezone_set('Asia/Jakarta');
$value4 = date("Y-m-d H:i:s");
$stmt->execute();

// Error handle -> Check if the message is succesfully sent
if ($stmt->error) {
    // Error
    header("Location: ../error.php");
    die();
} else {
    // Check if the message exist in database
    $sql = "SELECT * FROM chats WHERE sender_id=? AND target_id=? AND content=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $value1, $value2, $value3);
    $value1 = $_SESSION["userId"];
    $value2 = $_GET["targetId"];
    $value3 = $_POST["message"];
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row) {
        // Success
        header("Location: ../chatLog.php?targetId=" . $_GET["targetId"]);
        die();
    } else {
        // Error
        header("Location: ../error.php");
        die();
    }
}

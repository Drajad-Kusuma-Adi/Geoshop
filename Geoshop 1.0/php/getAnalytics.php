<?php
require_once "config.php";

$sql = "SELECT * FROM analytics WHERE name = 'total_guest'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalGuests = $row['content'];

$sql = "SELECT * FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$totalUsers = $result->num_rows;

$sql = "SELECT * FROM users WHERE is_shop = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$totalShops = $result->num_rows;

$sql = "SELECT * FROM users WHERE is_warn = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$warnedUsers = $result->num_rows;

$sql = "SELECT * FROM users WHERE is_timeout = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$timeoutUsers = $result->num_rows;

$sql = "SELECT * FROM users WHERE is_ban = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$bannedUsers = $result->num_rows;

$sql = "SELECT * FROM users WHERE is_admin = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$totalAdmins = $result->num_rows;

$conn->close();

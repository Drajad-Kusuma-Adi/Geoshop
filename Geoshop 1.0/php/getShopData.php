<?php
session_start();
require_once "config.php";
$shopId = $_GET['shopId'];

if (isset($_SESSION['shopName'])) {
    unset($_SESSION['shopName']);
}
if (isset($_SESSION['shopPhoto'])) {
    unset($_SESSION['shopPhoto']);
}
if (isset($_SESSION['ownerId'])) {
    unset($_SESSION['ownerId']);
}
if (isset($_SESSION['shopLatitude'])) {
    unset($_SESSION['shopLatitude']);
}
if (isset($_SESSION['shopLongitude'])) {
    unset($_SESSION['shopLongitude']);
}

$sql = "SELECT * FROM shops WHERE shop_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $shopId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$_SESSION['shopName'] = $row['shop_name'];
if (!isset($_SESSION['shopName'])) {
    error_log('$_SESSION[\'shopName\'] is unset.');
    print_r($row);
    die('An error occurred.');
}

$_SESSION['shopPhoto'] = $row['photo'];
if (!isset($_SESSION['shopPhoto'])) {
    error_log('$_SESSION[\'shopPhoto\'] is unset.');
    print_r($row);
    die('An error occurred.');
}

$_SESSION['ownerId'] = $row['owner_id'];
if (!isset($_SESSION['ownerId'])) {
    error_log('$_SESSION[\'ownerId\'] is unset.');
    print_r($row);
    die('An error occurred.');
}

$_SESSION['shopLatitude'] = $row['latitude'];
if (!isset($_SESSION['shopLatitude'])) {
    error_log('$_SESSION[\'shopLatitude\'] is unset.');
    print_r($row);
    die('An error occurred.');
}

$_SESSION['shopLongitude'] = $row['longitude'];
if (!isset($_SESSION['shopLongitude'])) {
    error_log('$_SESSION[\'shopLongitude\'] is unset.');
    print_r($row);
    die('An error occurred.');
}

$stmt->close();
$conn->close();

header("Location: ../user/shopView.php");

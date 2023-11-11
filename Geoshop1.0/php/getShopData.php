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
$shopId = $row['shop_id'];
$shopName = $row['shop_name'];
$photo = $row['photo'];
$ownerId = $row['owner_id'];
$shopLatitude = $row['latitude'];
$shopLongitude = $row['longitude'];

$_SESSION['shopId'] = $shopId;
$_SESSION['shopName'] = $shopName;
$_SESSION['shopPhoto'] = $photo;
$_SESSION['ownerId'] = $ownerId;
$_SESSION['shopLatitude'] = $shopLatitude;
$_SESSION['shopLongitude'] = $shopLongitude;

$_SESSION['userLatitude'] = $_GET['userLatitude'];
$_SESSION['userLongitude'] = $_GET['userLongitude'];

if (!isset($shopName, $ownerId, $shopLatitude, $shopLongitude)) {
    error_log('One or more session variables are not set.');
    echo '<a href="' . $_SERVER["HTTP_REFERER"] . '">Go back</a>';
    die("Error, session variables not set. If data is printed out in this page, please contact an admin to get it fixed.");
}

$stmt->close();
$conn->close();
header("Location: ../user/shopView.php");

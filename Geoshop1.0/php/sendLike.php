<?php
session_start();
require_once "config.php";

$userId = $_GET['userId'];
$productId = $_GET['productId'];

$sql = "SELECT * FROM product_likes WHERE user_id=? AND product_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $userId, $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $sql = "DELETE FROM product_likes WHERE user_id=? AND product_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $userId, $productId);
    $stmt->execute();
} else {
    $sql = "INSERT INTO product_likes (user_id, product_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $userId, $productId);
    $stmt->execute();
}

$sql = "SELECT * FROM product_dislikes WHERE user_id=? AND product_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $userId, $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $sql = "DELETE FROM product_dislikes WHERE user_id=? AND product_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $userId, $productId);
    $stmt->execute();
} else {
    $sql = "INSERT INTO product_dislikes (user_id, product_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $userId, $productId);
    $stmt->execute();
}

header("Location: ../user/productView.php?productId=" . $productId);

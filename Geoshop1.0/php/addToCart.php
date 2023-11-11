<?php
session_start();

$productId = $_POST['itemId'];
$productName = $_POST['itemName'];
$productPrice = $_POST['itemPrice'];
$productPhoto = $_POST['itemPhoto'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$newItem = [
    "productName" => $productName,
    "productPrice" => $productPrice,
    "productPhoto" => $productPhoto,
];

array_push($_SESSION['cart'], $newItem);

// $sql = "SELECT stock FROM products WHERE product_id = ?";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("s", $productId);
// $stmt->execute();
// $result = $stmt->get_result();
// $row = $result->fetch_assoc();

// $previousStock = $row['stock'];
// $currentStock = $previousStock - 1;

// $sql = "UPDATE products SET stock = ? WHERE product_id = ?";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("is", $currentStock, $productId);
// $stmt->execute();
// TODO: Put this after transaction confirmation, refer to checkoutTransactionPage.php

header("Location: ../user/checkoutTransactionPage.php");

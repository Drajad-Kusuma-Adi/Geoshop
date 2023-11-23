<?php
session_start();

$productId = $_POST['itemId'];
$productName = $_POST['itemName'];
$productPrice = $_POST['itemPrice'];
$productPhoto = $_POST['itemPhoto'];
$productShop = $_POST['itemVendor'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$newItem = [
    "productId" => $productId,
    "productName" => $productName,
    "productPrice" => $productPrice,
    "productPhoto" => $productPhoto,
    "productShop" => $productShop
];

array_push($_SESSION['cart'], $newItem);

header("Location: ../user/cart.php");

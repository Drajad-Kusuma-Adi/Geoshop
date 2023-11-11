<?php
require_once "config.php";

// Get the data from the POST request
$productId = $_POST['productId'];
$modifyPhoto = $_POST['productImage'];
$modifyName = $_POST['productName'];
$modifyDescription = $_POST['productDescription'];
$modifyPrice = $_POST['productPrice'];
$modifyStock = $_POST['productStock'];

// Retrieve the current data for the product from the database
$sql = "SELECT * FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$value1 = $productId;
$stmt->bind_param("s", $value1);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$currentPhoto = $row['photo'];
$currentName = $row['name'];
$currentDescription = $row['description'];
$currentPrice = $row['price'];
$currentStock = $row['stock'];

// Prepare the SQL statement for updating the product
$sql = "UPDATE products SET ";
$params = array();

// Check if each field needs to be modified and add it to the SQL statement
if ($modifyPhoto !== null && $modifyPhoto != $currentPhoto) {
    $sql .= "photo = ?, ";
    $params[] = $modifyPhoto;
}
if ($modifyName !== null && $modifyName != $currentName) {
    $sql .= "name = ?, ";
    $params[] = $modifyName;
}
if ($modifyDescription !== null && $modifyDescription != $currentDescription) {
    $sql .= "description = ?, ";
    $params[] = $modifyDescription;
}
if ($modifyPrice !== null && $modifyPrice != $currentPrice) {
    $sql .= "price = ?, ";
    $params[] = $modifyPrice;
}
if ($modifyStock !== null && $modifyStock != $currentStock) {
    $sql .= "stock = ?, ";
    $params[] = $modifyStock;
}

// Remove the trailing comma and space from the SQL statement
$sql = rtrim($sql, ", ");
$sql .= " WHERE product_id = ?";
$params[] = $productId;

// Execute the update statement
$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat("s", count($params)), ...$params);
$stmt->execute();

// Redirect the user to the modifyProduct.php page
header("Location: ../shop/modifyProduct.php");

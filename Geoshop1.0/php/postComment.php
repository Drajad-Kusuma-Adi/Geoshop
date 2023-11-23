<?php
session_start();
require_once "config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commenterId = $_SESSION['userId'];
    $productId = $_GET['productId'];
    $content = $_POST['typeCommentBox'];

    $sql = "INSERT INTO product_comments (user_id, product_id, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $commenterId, $productId, $content);
    $stmt->execute();

    $stmt->close();
    $conn->close();
    header("Location: ../user/productView.php?productId=" . $productId);
}

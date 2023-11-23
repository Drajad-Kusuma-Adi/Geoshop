<?php
session_start();
require_once "config.php";

function removeTempFrom($target)
{
    $target = str_replace("_TEMP", "", $target);
    return $target;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productImage = $_GET["productImage"];
    $productName = $_POST["productName"];
    $productDescription = $_POST["productDescription"];
    $productPrice = $_POST["productPrice"];
    $productStock = $_POST["productStock"];

    $permanentImage = removeTempFrom($productImage);
    rename($productImage, $permanentImage);

    try {
        $sql = "INSERT INTO products (product_name, shop_id, photo, price, stock, description) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $value1, $value2, $value3, $value4, $value5, $value6);
        $value1 = $productName;
        $value2 = $_SESSION["assetId"];
        $value3 = $permanentImage;
        $value4 = $productPrice;
        $value5 = $productStock;
        $value6 = $productDescription;
        $stmt->execute();
    } catch (Exception $e) {
        echo "<a href='../user/userProfile.php'>Go back</a>";
        die("Something went wrong: " . $e->getMessage());
    }
}

$stmt->close();
$conn->close();
header("Location: ../user/manageProducts.php");
exit();

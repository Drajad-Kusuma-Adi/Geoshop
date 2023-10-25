<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
</head>
<body>
    <form action="../php/manageProduct.php" method="post" enctype='multipart/form-data'>
        <label for="productImage"><img src="../images/blankShop.png" alt="Product Image label" width="10%" height="10%"></label>
        <input type="file" name="productImage" id="productImage">
        <br>
        <label for="productName">Product name:</label>
        <br>
        <input type="text" name="productName" id="productName">
        <br>
        <label for="productDescription">Description:</label>
        <br>
        <input type="text" name="productDescription" id="productDescription">
        <br>
        <label for="productPrice">Price:</label>
        <br>
        IDR
        <input type="number" name="productPrice" id="productPrice">
        <br>
        <input type="submit" value="Add">
    </form>
</body>
</html>
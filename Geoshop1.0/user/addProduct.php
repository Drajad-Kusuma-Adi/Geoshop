<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: #F1F1F1;
            color: black;
        }

        a {
            text-decoration: none;
            color: black;
        }

        .img-overlay {
            position: absolute;
            opacity: 0;
            top: 0;
            left: 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 25%;
            }
        }

        .position-relative:hover #addSignOverlay {
            animation: fadeIn 1s forwards;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php require_once "../header.php" ?>
    <main>
        <p class="fs-1 fw-bold text-center">Add Product</p>
        <div class="container p-4 rounded" style="background-color: #F6F4EB; text-align: center;">
            <div class="form-group mb-3">
                <p class="fs-5">Product image</p>
                <form action="../php/previewProductImage.php" method="POST" enctype="multipart/form-data">
                    <label class="d-flex align-items-center justify-content-center">
                        <div class="position-relative">
                            <img src="<?php
                                        if (isset($_GET["tempImage"]) && !empty($_GET["tempImage"]) && file_exists($_GET["tempImage"])) {
                                            if (file_exists($_GET["tempImage"])) {
                                                echo $_GET["tempImage"];
                                            }
                                        } else {
                                            echo "../images/blankProduct.png";
                                        }
                                        ?>" alt="Product Image label" width="100" height="100" class="text-center" id="editProductImage">
                            <img src=" ../images/addSign.png" alt="Add Sign" width="100" height="100" class="text-center img-overlay" id="addSignOverlay">
                        </div>
                        <input class="form-control" type="file" name="displayProductImage" id="displayProductImage" hidden>
                        <input type="submit" name="submitDisplay" id="submitDisplay" hidden>
                        <script>
                            let displayProductImage = document.getElementById("displayProductImage");
                            let submitDisplay = document.getElementById("submitDisplay");
                            displayProductImage.addEventListener("input", function() {
                                submitDisplay.click();
                            });
                        </script>
                    </label>
                </form>
            </div>
            <br>
            <form action="../php/addProduct.php?productImage=<?php if (isset($_GET["tempImage"]) && file_exists($_GET["tempImage"])) {
                                                                    echo $_GET["tempImage"];
                                                                } ?>" method="POST" enctype='multipart/form-data'>
                <div class="form-group mb-3">
                    <label class="fs-5" for="productName">Product name:</label>
                    <input required class="form-control" type="text" name="productName" id="productName">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label class="fs-5" for="productDescription">Description:</label>
                    <textarea class="form-control" name="productDescription" id="productDescription" style="height: 20vw; resize: none;"></textarea>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label class="fs-5" for="productPrice">Price:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                        </div>
                        <input required class="form-control" type="number" name="productPrice" id="productPrice">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="fs-5" for="productStock">Current stock:</label>
                    <input required class="form-control" type="number" name="productStock" id="productStock">
                </div>
                <br>
                <input required class="btn btn-primary rounded-pill fs-5" type="submit" value="Add" style="width: 80vw;">
                <a href="manageProducts.php" class="btn btn-light rounded-pill mt-2 fs-5" style="width: 80vw">Cancel</a>
            </form>
        </div>
    </main>
    <div id="unlinkImage"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
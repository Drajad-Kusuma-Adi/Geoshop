<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
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
    </style>
</head>

<body>
    <?php require_once "../header.php"; ?>
    <main>
        <div class="text-center m-3">
            <p class="btn btn-primary text-center fs-3 fw-bold px-4 py-2 rounded-3">
                <a href="addProduct.php" style="color: white;">
                    <svg width="48px" height="48px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#FFFFFF">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <title>plus-square</title>
                            <desc>Created with Sketch Beta.</desc>
                            <defs> </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-100.000000, -1035.000000)" fill="#FFFFFF">
                                    <path d="M130,1063 C130,1064.1 129.104,1065 128,1065 L104,1065 C102.896,1065 102,1064.1 102,1063 L102,1039 C102,1037.9 102.896,1037 104,1037 L128,1037 C129.104,1037 130,1037.9 130,1039 L130,1063 L130,1063 Z M128,1035 L104,1035 C101.791,1035 100,1036.79 100,1039 L100,1063 C100,1065.21 101.791,1067 104,1067 L128,1067 C130.209,1067 132,1065.21 132,1063 L132,1039 C132,1036.79 130.209,1035 128,1035 L128,1035 Z M122,1050 L117,1050 L117,1045 C117,1044.45 116.552,1044 116,1044 C115.448,1044 115,1044.45 115,1045 L115,1050 L110,1050 C109.448,1050 109,1050.45 109,1051 C109,1051.55 109.448,1052 110,1052 L115,1052 L115,1057 C115,1057.55 115.448,1058 116,1058 C116.552,1058 117,1057.55 117,1057 L117,1052 L122,1052 C122.552,1052 123,1051.55 123,1051 C123,1050.45 122.552,1050 122,1050 L122,1050 Z" id="plus-square" sketch:type="MSShapeGroup"> </path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Add New Product
                </a>
            </p>
        </div>
        <div class="d-flex flex-row justify-content-center flex-wrap m-3" style="border: 2px solid black; border-radius: 10px; overflow-y: scroll;">
            <?php
            require_once "../php/config.php";
            $sql = "SELECT * FROM products WHERE shop_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $value1);
            $value1 = $_SESSION["assetId"];
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_all(MYSQLI_ASSOC);

            foreach ($row as $value) {
                $productId = $value['product_id'];
                $productName = $value['product_name'];
                $shopId = $value['shop_id'];
                $photo = $value['photo'];
                $price = $value['price'];
                $stock = $value['stock'];
                $description = $value['description'];
            ?>
                <div class=" card m-2 rounded-3 col-md-3 col-9" style="background-color: white;">
                    <img src="<?php
                                if (file_exists($photo) == false) {
                                    echo "../images/blankShop.png";
                                } else {
                                    echo $photo;
                                }
                                ?>" alt="Product Image" class="card-img-top" style="width: 100%; height: 250px;">
                    <div class="card-body d-flex flex-column justify-content-between m-4">
                        <div>
                            <p class="card-title fs-2 fw-bold text-center"><?php echo $productName ?></p>
                            <p class="card-text fs-4 text-center"><?php echo "IDR. " . strval(number_format($price)); ?></p>
                        </div>
                    </div>
                    <a href="modifyProduct.php?productId=<?php echo $productId ?>" class="btn btn-primary text-center fs-3 fw-bold px-4 py-2 rounded-3">Modify</a>
                </div>
            <?php } ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
<?php
    require_once "config.php";
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productPhoto = $_FILES["productImage"];
        $productName = $_POST["productName"];
        $productDescription = $_POST["productDescription"];
        $productPrice = $_POST["productPrice"];

        $target_dir = "../productImage/";
        $nameProductImage = basename($_FILES["productImage"]["name"]);
        $target_file = $target_dir . $nameProductImage;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
            $uploadOk = 0;
            die;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
                // $sql = "INSERT INTO products (product_name, description, price, shop_id) VALUES (?, ?, ?, ?)";
                // $stmt = $conn->prepare($sql);
                // $stmt->bind_param("ssss", $value1, $value2, $value3, $value4);
                // $value1 = $productName;
                // $value2 = $productDescription;
                // $value3 = $productPrice;
                // $value4 = $_SESSION["shopId"];
                // $stmt->execute();
                // TODO: Shop ID

                $sql = "INSERT INTO products (product_name, description, price, photo) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $value1, $value2, $value3, $value5);
                $value1 = $productName;
                $value2 = $productDescription;
                $value3 = $productPrice;
                // $value4 = $_SESSION["shopId"];
                $value5 = $target_file;
                $stmt->execute();
            } else {
                echo "Sorry, there was an error uploading your file.";
                die;
            }
    }
?>
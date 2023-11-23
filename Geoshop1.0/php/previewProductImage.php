<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "../productImage/";

    // Check if the "displayProductImage" key exists in the $_FILES array
    if (isset($_FILES["displayProductImage"])) {
        $nameDisplayProduct = basename($_FILES["displayProductImage"]["name"]);
        $randomFileName = uniqid() . "_TEMP_" . $nameDisplayProduct;
        $target_file = $target_dir . $randomFileName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
            header("Location: ../user/addProduct.php?uploadError=1");
        } else {
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            ) {
                $uploadOk = 0;
                header("Location: ../user/addProduct.php?uploadError=1");
            } else {
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    header("Location: ../user/addProduct.php?uploadError=1");
                    // if everything is ok, try to upload file
                } else {
                    move_uploaded_file($_FILES["displayProductImage"]["tmp_name"], $target_file);
                    if (file_exists($target_file)) {
                        header("Location: ../user/addProduct.php?tempImage=" . $target_file);
                    } else {
                        header("Location: ../user/addProduct.php?uploadError=1");
                    }
                }
            }
        }
    }
}

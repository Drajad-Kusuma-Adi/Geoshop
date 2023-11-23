<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $editProfilePictureShop = $_FILES["editProfilePictureShop"];

    $target_dir = "../profilePicture/";
    $nameProfilePicture = basename($_FILES["editProfilePictureShop"]["name"]);
    $randomFileName = uniqid() . "_" . $nameProfilePicture;
    $target_file = $target_dir . $randomFileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        header("Location: ../user/userProfile.php?uploadError=1");
        exit();
    } else {
        $sql = "SELECT * FROM shops WHERE owner_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $value1);
        $value1 = $_SESSION["userId"];
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $shopProfile = $result->fetch_assoc();
            if (file_exists("../profilePicture/" . $shopProfile["photo"])) {
                unlink("../profilePicture/" . $shopProfile["photo"]);
            }
        }
        if (move_uploaded_file($_FILES["editProfilePictureShop"]["tmp_name"], $target_file)) {
            $sql = "UPDATE shops SET photo=? WHERE owner_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $value1, $value2);
            $value1 = $randomFileName;
            $value2 = $_SESSION["userId"];
            $stmt->execute();

            if ($stmt->errno) {
                echo "<a href='../user/userProfile.php'>Go back</a>";
                die("Something went wrong, please try again");
            }
            $stmt->close();
            $_SESSION["assetPhoto"] = $randomFileName;
        } else {
            header("Location: ../user/userProfile.php?uploadError=1");
        }
    }
}

$conn->close();
header("Location: ../user/userProfile.php");

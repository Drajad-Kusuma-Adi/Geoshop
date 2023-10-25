<?php
    session_start();
    require_once "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $editUsername = $_POST["editUsername"];
        $editEmail = $_POST["editEmail"];
        $editProfilePicture = $_FILES["editProfilePicture"];

        $target_dir = "../user/profilePicture/";
        $nameProfilePicture = basename($_FILES["editProfilePicture"]["name"]);
        $randomFileName = uniqid() . "_" . $nameProfilePicture;
        $target_file = $target_dir . $randomFileName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["editProfilePicture"]["tmp_name"], $target_file)) {
                $sql = "SELECT * FROM users WHERE user_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $value1);
                $value1 = $_SESSION["userId"];
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $profile = $result->fetch_assoc();
                    if (file_exists("../user/profilePicture/" . $profile["photo"])) {
                        unlink("../user/profilePicture/" . $profile["photo"]);
                    }
                }

                $sql = "UPDATE users SET username=?, email=?, photo=? WHERE user_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $value1, $value2, $value3, $value4);
                $value1 = $editUsername;
                $value2 = $editEmail;
                $value3 = $randomFileName;
                $value4 = $_SESSION["userId"];
                $stmt->execute();

                if ($stmt->errno) {
                    echo "<a href='../user/userProfile.php'>Go back</a>";
                    die("Something went wrong, please try again");
                }
                $stmt->close();
                $_SESSION["username"] = $editUsername;
                $_SESSION["email"] = $editEmail;
                $_SESSION["profilePicture"] = $randomFileName;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    $conn->close();
    header("Location: ../user/userProfile.php");
?>
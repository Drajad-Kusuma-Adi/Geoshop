<?php
    session_start();
    require_once "config.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $loginEmail = $_POST["loginEmail"];
        $loginPassword= $_POST["loginPassword"];
        $randomizer = "1984";
        $passwordmd = md5($randomizer.md5($_POST["loginPassword"]));

        $sql = "SELECT * FROM users WHERE email=? AND password=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $value1, $value2);
        $value1 = $loginEmail;
        $value2 = $passwordmd;
        $stmt->execute();

        if ($stmt->errno) {
            die();
        }

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $profile = $result->fetch_assoc();
            header("Location: ../user/userMap.php");
        } else {
            echo "<a href='../loginPage.php'>Retry</a>";
            die("Invalid data");
        }

        $_SESSION["userId"] = $profile["user_id"];
        $_SESSION["username"] = $profile["username"];
        $_SESSION["email"] = $profile["email"];
        $_SESSION["password"] = $profile["password"];
        $_SESSION["isShop"] = $profile["is_shop"];
        $_SESSION["profilePicture"] = $profile["photo"];
        $_SESSION["warned"] = $profile["is_warn"];
        $_SESSION["timeout"] = $profile["is_timeout"];
        $_SESSION["banned"] = $profile["is_ban"];

        $stmt->close();
        $conn->close();
    }
?>
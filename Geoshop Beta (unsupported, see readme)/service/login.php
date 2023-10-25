<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sqlLogin = "SELECT * FROM user_table WHERE email = '$email' AND password = '$password'";
    $resultLogin = $conn->query($sqlLogin);

    if ($resultLogin->num_rows > 0) {
        echo "Login Successful";
        $profileGet = "SELECT username, user_id, email, is_shop FROM user_table WHERE email = '$email' AND password = '$password'";
        $resultProfile = $conn->query($profileGet);

        if ($resultProfile->num_rows > 0) {
            $profileRow = $resultProfile->fetch_assoc();
            $userIdProfile = $profileRow["user_id"];
            $usernameProfile = $profileRow["username"];
            $emailProfile = $profileRow["email"];
            $isShop = $profileRow["is_shop"];
        } else {
            die("Oops! Something went wrong.");
        }
        session_start();
        $_SESSION["user_id"] = $userIdProfile;
        $_SESSION["username"] = $usernameProfile;
        $_SESSION["email"] = $emailProfile;
        $_SESSION["is_shop"] = $isShop;
        header("Location: ../page/mapView.php");
    } else {
        echo "Invalid email or password";
        header("Location: ../page/loginPageFail.php");
    }
}

$conn->close();
?>
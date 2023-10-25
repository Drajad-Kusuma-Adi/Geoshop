<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailRegister = $_POST["emailRegister"];
    $usernameRegister = $_POST["usernameRegister"];
    $passwordRegister = $_POST["passwordRegister"];
    $phoneNumber = $_POST["phoneNumber"];

    $sqlRegister = 'INSERT INTO user (email, username, password, phone_number) VALUES ("' . $emailRegister . '", "' . $usernameRegister . '", "' . $passwordRegister . '", "' . $phoneNumber . '");';
    $conn->query($sqlRegister);
    echo "Registration successful";
}

$conn->close();
header("Location: ../page/loginPage.php")
?>

<!-- TODO:
- Prevent the guest from registering if the email have capital letter in it.
- Create an email verification system. Send the user register code in their email. -->
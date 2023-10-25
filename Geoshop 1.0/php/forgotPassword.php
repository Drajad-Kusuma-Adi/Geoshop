<?php
    require_once "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $resetEmail = $_POST["resetEmail"];

        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $value1);
        $value1 = $resetEmail;
        $stmt->execute();
        if ($stmt->errno) {
            echo "<a href='../index.php'>Back to home</a>";
            die("Something went wrong, please try again");
        }

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $userId = $result->fetch_assoc()["user_id"];
            $resetPasswordPage = "http://localhost/Geoshop/Geoshop 1.0/resetPasswordPage.php?userId=$userId";

            $to = $resetEmail;
            $subject = "Reset Password";
            $message = "Click the link below to reset your password:\n\n$resetPasswordPage";
            $headers = "From: drajadkusumaadi@gmail.com\r\n";
            mail($to, $subject, $message, $headers);
        }
    }

    echo "Check your email to continue reset password";
    $stmt->close();
    $conn->close();
?>

<?php
    session_start();
    require_once "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $editUsername = $_POST["editUsername"];
        $editEmail = $_POST["editEmail"];

        $sql = "UPDATE users SET username=?, email=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $value1, $value2, $value3);
        $value1 = $editUsername;
        $value2 = $editEmail;
        $value3 = $_SESSION["userId"];
        $stmt->execute();

        if ($stmt->errno) {
            echo "<a href='../user/userProfile.php'>Go back</a>";
            die("Something went wrong, please try again");
        }
        $stmt->close();
        $_SESSION["username"] = $editUsername;
        $_SESSION["email"] = $editEmail;
    }

    $conn->close();
    header("Location: ../user/userProfile.php");
?>

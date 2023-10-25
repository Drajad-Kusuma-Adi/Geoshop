<?php
    require_once "config.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $registerEmail = $_POST["registerEmail"];
        $registerUsername = $_POST["registerUsername"];
        $registerPassword = $_POST["registerPassword"];
        $confirmPassword = $_POST["confirmPassword"];
        $randomizer = "1984";
        $passwordmd = md5($randomizer.md5($_POST["registerPassword"]));

        if ($registerPassword != $confirmPassword) {
            die("Password unconfirmed");
        }

        $sql = "SELECT * FROM users WHERE email=? AND username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $value1, $value2);
        $value1 = $registerEmail;
        $value2 = $registerUsername;
        $stmt->execute();
        $result = $stmt->get_result();

        if ($stmt->errno) {
            echo "Error: " . $stmt->error;
            echo "<a href='../index.php'>Go back</a>";
            die();
        }

        if ($result->num_rows > 0) {
            header("Location: ../registerPageFail.php");
            die();
        } else {
            $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $value1, $value2, $value3);
            $value1 = $registerEmail;
            $value2 = $registerUsername;
            $value3 = $passwordmd;
            $stmt->execute();

            if ($stmt->errno) {
                echo "Error: " . $stmt->error;
                echo "<a href='../index.php'>Go back</a>";
                die();
            }
        }

        $stmt->close();
        $conn->close();
    }
    header("Location: ../loginPage.php");
?>
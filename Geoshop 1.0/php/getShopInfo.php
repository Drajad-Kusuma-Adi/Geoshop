<?php
    session_start();
    require_once "config.php";

    $sql = "SELECT * FROM shops WHERE owner_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $value1);
    $value1 = $_SESSION["userId"];
?>
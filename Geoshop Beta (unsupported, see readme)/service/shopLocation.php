<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "geoshop";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sqlQuery = "SELECT * FROM shop_table";
    $resultQuery = $conn->query($sqlQuery);
    $rowResultQuery = $resultQuery->fetch_all(MYSQLI_ASSOC);

    // Return the array as JSON response.
    header('Content-Type: application/json');
    echo json_encode($rowResultQuery);
?>
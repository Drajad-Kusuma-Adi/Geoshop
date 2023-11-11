<?php
require_once "config.php";

$sql = "SELECT * FROM shops";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_all(MYSQLI_ASSOC);

header('Content-Type: application/json');
echo json_encode($row);

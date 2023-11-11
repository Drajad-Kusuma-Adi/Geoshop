<?php
require_once "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ignore'])) {
        $value1 = "ignored";
    } else if (isset($_POST['warn'])) {
        $value1 = "warned";
        $sql = "UPDATE users SET is_warn = 1 WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_POST["violatorId"]);
        $stmt->execute();
    } else if (isset($_POST['timeout'])) {
        $value1 = "timeout";
        $sql = "UPDATE users SET is_timeout = 1, timeout_end = DATE_ADD(NOW(), INTERVAL 3 DAY) WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_POST["violatorId"]);
        $stmt->execute();
    } else if (isset($_POST['ban'])) {
        $value1 = "banned";
        $sql = "INSERT INTO voting ('voting_count', 'deletion_time') VALUES (1, DATE_ADD(NOW(), INTERVAL 3 DAY))";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    $sql = "UPDATE reports SET admin_response = ? WHERE report_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $value1, $value2);
    $value2 = $_POST['report_id'];
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
header("Location: ../admin/adminReports.php");

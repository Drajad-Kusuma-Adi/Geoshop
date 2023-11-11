<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: #F1F1F1;
            color: black;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <header>
        <div class="d-flex flex-column flex-shrink-0 p-3" style="width: 100%; background-color: #F6F4EB;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img src="../images/GeoshopLogo.png" alt="Geoshop Logo" width="64" height="64" class="rounded-circle me-2">
                <span class="fs-4 fw-bold">Geoshop</span>
            </a>
            <div class="d-flex flex-row align-items-center">
                <img src="../profilePicture/blankUser.jpg" width="32" height="32" class="rounded-circle">
                <div class="dropend">
                    <button class="btn bg-transparent dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fs-4 fw-bold">Admin</span>
                    </button>
                    <div class="dropdown-menu">
                        <a href="../php/logout.php" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Menu
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a href="adminDashboard.php" class="dropdown-item">
                            <img src="../images/adminDashboard.png" alt="Admin Dashboard" width="32" height="32">
                            <span class="fs-4 fw-bold" style="text-decoration: none; color: black;">Dashboard</span>
                        </a></li>
                    <li><a href="adminManageUsers.php" class="dropdown-item">
                            <img src="../images/adminManageUser.png" alt="Manage Users" width="32" height="32">
                            <span class="fs-4 fw-bold" style="text-decoration: none; color: black;">Manage Users</span>
                        </a></li>
                    <li><a href="adminReports.php" class="dropdown-item">
                            <img src="../images/adminReports.png" alt="Reports" width="32" height="32">
                            <span class="fs-4 fw-bold" style="text-decoration: none; color: black;">Reports</span>
                        </a></li>
                    <li><a href="adminVoting.php" class="dropdown-item">
                            <img src="../images/adminVoting.png" alt="Voting" width="32" height="32">
                            <span class="fs-4 fw-bold" style="text-decoration: none; color: black;">Voting</span>
                        </a></li>
                </ul>
            </div>
        </div>
    </header>
    <main>
        <div class="d-flex flex-column">
            <table>
                <thead>
                    <th>Reporter</th>
                    <th>Violator</th>
                    <th>Description</th>
                    <th>Voting Expiration</th>
                    <th>Voting Count</th>
                    <th>Vote?</th>
                </thead>
                <tbody>
                    <?php
                    require_once "../php/config.php";

                    $sql = "SELECT * FROM voting";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $rows = $result->fetch_all(MYSQLI_ASSOC);

                    foreach ($rows as $row) {
                        if (date('Y-m-d H:i:s') > $row['date']) {
                            $delete_sql = "DELETE FROM voting WHERE voting_id=?";
                            $delete_stmt = $conn->prepare($delete_sql);
                            $delete_stmt->bind_param("i", $row['voting_id']);
                            $delete_stmt->execute();
                        } else {
                            $reporter_sql = "SELECT username FROM users WHERE user_id=?";
                            $reporter_stmt = $conn->prepare($reporter_sql);
                            $reporter_stmt->bind_param("i", $row['reporter_id']);
                            $reporter_stmt->execute();
                            $reporter_result = $reporter_stmt->get_result();
                            $reporter = $reporter_result->fetch_assoc();
                    ?>
                            <tr><?php echo $reporter['username']; ?></tr>
                            <?php
                            $violator_sql = "SELECT username FROM users WHERE user_id=?";
                            $violator_stmt = $conn->prepare($violator_sql);
                            $violator_stmt->bind_param("i", $row['violator_id']);
                            $violator_stmt->execute();
                            $violator_result = $violator_stmt->get_result();
                            $violator = $violator_result->fetch_assoc();
                            ?>
                            <tr><?php echo $violator['username']; ?></tr>
                            <tr><?php echo $row['report_message']; ?></tr>
                            <tr><?php echo $row['date']; ?></tr>
                            <tr><?php echo $row['voting_count']; ?></tr>
                            <tr><button>Vote</button></tr>
                    <?php
                        }
                    }
                    $stmt->close();
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reports</title>
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

        @keyframes scaleIn {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.05);
            }
        }

        @keyframes scaleOut {
            0% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .reportRow {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .reportRow:hover {
            animation: scaleIn 0.3s forwards;
        }

        .reportRow:not(:hover) {
            animation: scaleOut 0.3s forwards;
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
                    <li><a href="adminUsers.php" class="dropdown-item">
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
                    <th>Report Date</th>
                    <th>Description</th>
                </thead>
                <tbody>
                    <?php
                    require_once "../php/config.php";
                    $sql = "SELECT * FROM reports ORDER BY date ASC WHERE admin_response IS NULL";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_all(MYSQLI_ASSOC);
                    foreach ($row as $value) {
                        $reportId = $value["report_id"];
                    ?>
                        <tr class="reportRow" data-bs-toggle="modal" data-bs-target="#processReport">
                            <td><?php
                                $sql = "SELECT username FROM users WHERE user_id=" . $value['reporter_id'];
                                $res = $conn->query($sql);
                                if ($res->num_rows > 0) {
                                    while ($row = $res->fetch_assoc()) {
                                        $reporterId = $row["username"];
                                        echo $reporterId;
                                    }
                                }
                                ?> </td>
                            <td><?php
                                $sql = "SELECT username FROM users WHERE user_id=" . $value['violator_id'];
                                $res = $conn->query($sql);
                                if ($res->num_rows > 0) {
                                    while ($row = $res->fetch_assoc()) {
                                        $violatorId = $row["username"];
                                        echo $violatorId;
                                    }
                                }
                                ?> </td>
                            <td><?php echo $value['date']; ?> </td>
                            <td><?php echo $value['report_message']; ?> </td>
                        </tr>
                    <?php }
                    $stmt->close();
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <div class="modal fade" id="processReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="processReport">Process Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <script>
                    function changeSize(button) {
                        button.style.transform = "scale(1.2)";

                        let confirmationMessage = document.createElement('p');
                        confirmationMessage.innerText = "Are you sure?";

                        let yesButton = document.createElement('button');
                        yesButton.innerText = 'Yes';
                        yesButton.addEventListener('click', () => {
                            document.getElementById(button.innerText.toLowerCase()).checked = true;
                            document.querySelector('form').submit();
                        });
                        yesButton.style.color = 'blue';
                        yesButton.style.backgroundColor = 'transparent';
                        yesButton.style.border = 'none';
                        yesButton.style.marginRight = '1vw';

                        let noButton = document.createElement('button');
                        noButton.innerText = 'No';
                        noButton.addEventListener('click', () => {
                            button.style.transform = "scale(1)";
                            button.parentElement.removeChild(confirmationMessage);
                            button.parentElement.removeChild(yesButton);
                            button.parentElement.removeChild(noButton);
                        });
                        noButton.style.color = 'blue';
                        noButton.style.backgroundColor = 'transparent';
                        noButton.style.border = 'none';
                        noButton.style.marginLeft = '1vw';

                        button.parentElement.appendChild(confirmationMessage);
                        button.parentElement.appendChild(yesButton);
                        button.parentElement.appendChild(noButton);
                    }

                    document.querySelectorAll('.modal-body button').forEach((button) => {
                        button.addEventListener('click', function() {
                            changeSize(this);
                        });
                    });
                </script>

                <form action="../php/processReport.php" method="POST">
                    <div class="modal-body">
                        <button class="btn btn-primary" type="button" onclick="changeSize(this)">Ignore</button>
                        <button class="btn btn-secondary" type="button" onclick="changeSize(this)">Warn</button>
                        <button class="btn btn-warning" type="button" onclick="changeSize(this)">Timeout</button>
                        <button class="btn btn-danger" type="button" onclick="changeSize(this)">Ban</button>
                    </div>
                    <input type="text" name="reportId" id="reportId" value="<?php echo $reportId; ?>" hidden>
                    <input type="text" name="reporterId" id="reporterId" value="<?php echo $reporterId; ?>" hidden>
                    <input type="text" name="violatorId" id="violatorId" value="<?php echo $violatorId; ?>" hidden>
                    <input type="checkbox" name="ignore" id="ignore" hidden>
                    <input type="checkbox" name="warn" id="warn" hidden>
                    <input type="checkbox" name="timeout" id="timeout" hidden>
                    <input type="checkbox" name="ban" id="ban" hidden>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
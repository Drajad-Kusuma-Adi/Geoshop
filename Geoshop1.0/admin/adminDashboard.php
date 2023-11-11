<?php
session_start();
require_once "../php/getAnalytics.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        <div class="container p-2 mb-2" style="border: 1px solid black; border-radius: 10px; width: 90%;">
            <canvas id="myChart"></canvas>
        </div>

        <div class="container p-2 mb-2" style="border: 1px solid black; border-radius: 10px; width: 90%;">
            <?php
            // Original dynamic PHP code commented out
            //require_once "../php/getAnalytics.php";

            // Added static data for testing
            $totalGuests = "10";
            $totalUsers = "20";
            $totalShops = "5";
            $warnedUsers = "2";
            $timeoutUsers = "1";
            $bannedUsers = "1";
            $totalAdmins = "3";
            ?>
            <p><span class="fs-4 fw-bold">Website Visited <?php echo "$totalGuests"; ?> Times</span></p>
            <p><span class="fs-4 fw-bold">Total Users:</span> <?php echo "$totalUsers"; ?> </p>
            <p><span class="fs-4 fw-bold">Total Shops:</span> <?php echo "$totalShops"; ?> </p>
            <p><span class="fs-4 fw-bold">Warned Users:</span> <?php echo "$warnedUsers"; ?> </p>
            <p><span class="fs-4 fw-bold">Timeout Users:</span> <?php echo "$timeoutUsers"; ?> </p>
            <p><span class="fs-4 fw-bold">Banned Users:</span> <?php echo "$bannedUsers"; ?> </p>
            <p><span class="fs-4 fw-bold">Total Admins:</span> <?php echo "$totalAdmins"; ?> </p>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Users', 'Shops', 'Warned Users', 'Timeout Users', 'Banned Users', 'Admins'],
                    datasets: [{
                        label: '# of Votes',
                        data: [<?php echo "$totalUsers"; ?>, <?php echo "$totalShops"; ?>, <?php echo "$warnedUsers"; ?>, <?php echo "$timeoutUsers"; ?>, <?php echo "$bannedUsers"; ?>, <?php echo "$totalAdmins"; ?>],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</body>

</html>
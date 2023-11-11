<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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
        <div class="container mt-4">
            <form action="" method="GET" class="d-flex">
                <input name="searchValue" class="form-control me-2" type="search" placeholder="Search User" aria-label="Search">
                <div class="d-flex-flex-column me-2">
                    <select name="searchBy" class="form-select" aria-label="Search Category">
                        <option>Search by</option>
                        <option value="byId">ID</option>
                        <option selected value="byUsername">Username</option>
                        <option value="byEmail">Email</option>
                    </select>
                </div>
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <?php
            require_once "../php/config.php";
            $sql = "SELECT * FROM users";
            if (isset($_GET['searchBy'])) {
                $searchBy = $_GET['searchBy'];
                if ($searchBy == "byId") {
                    $sql .= " WHERE id = " . $_GET['searchValue'];
                } else if ($searchBy == "byUsername") {
                    $sql .= " WHERE username LIKE '%" . $_GET['searchValue'] . "%'";
                } else if ($searchBy == "byEmail") {
                    $sql .= " WHERE email LIKE '%" . $_GET['searchValue'] . "%'";
                }
            }
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_all(MYSQLI_ASSOC);
            // while ($row = $result->fetch_all(MYSQLI_ASSOC)) {
            //     $userId = $row['id'];
            //     $username = $row['username'];
            //     $email = $row['email'];
            //     $isShop = $row['is_shop'];
            //     $isWarn = $row['is_warn'];
            //     $isTimeout = $row['is_timeout'];
            //     $isBan = $row['is_ban'];
            //     $isAdmin = $row['is_admin'];
            // }
            ?>
            <table class="table mt-2">
                <thead>
                    <tr>
                        <th scope="col">Num.</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Have Shop</th>
                        <th scope="col">Warned</th>
                        <th scope="col">Timeout</th>
                        <th scope="col">Banned</th>
                        <th scope="col">Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($row as $key => $value) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $key + 1; ?></th>
                            <td><?php echo $value['username']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td><?php echo ($value['is_shop'] == 1 ? "Yes" : "No"); ?></td>
                            <td><?php echo ($value['is_warn'] == 1 ? "Yes" : "No"); ?></td>
                            <td><?php echo ($value['is_timeout'] == 1 ? "Yes" : "No"); ?></td>
                            <td><?php echo ($value['is_ban'] == 1 ? "Yes" : "No"); ?></td>
                            <td><?php echo ($value['is_admin'] == 1 ? "Yes" : "No"); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
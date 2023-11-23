<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
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
    <?php require_once "../header.php"; ?>
    <main>
        <div class="container d-flex flex-column" style="background-color: #F1F1F1;">
            <?php
            require_once "../php/config.php";
            $sql = "SELECT * FROM transactions WHERE shop_id=? AND confirmation_datetime=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $_SESSION['assetId'], null);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_all(MYSQLI_ASSOC);

            foreach ($row as $transaction) {
                $sql = "SELECT * FROM users WHERE user_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $transaction["customer_id"]);
                $stmt->execute();
                $customerResult = $stmt->get_result();
                $customerRow = $customerResult->fetch_assoc();
            ?>
                <div class="container d-flex flex-column flex-md-row">
                    <img src="../profilePicture<?php echo $row["photo"]; ?>" alt="Customer photo" width="100" height="100">
                    <div class="d-flex flex-column">
                        <p class="fs-4 fw-normal">
                            <?php echo $customerRow["username"]; ?>
                        </p>
                        <p class="fs-4 fw-normal">
                            <?php
                            $row['products'] = json_decode($row['products']);
                            ?>
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
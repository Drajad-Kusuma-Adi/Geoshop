<?php
session_start();
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
    <header>
        <div class="container-fluid p-1 d-inline-flex border-bottom border-4" style="background-color: #F1F1F1;">
            <div class="float-start" style="margin-left: 2%;">
                <a href="userMap.php">
                    <img src="../images/GeoshopLogo.png" alt="Geoshop Logo" width="25%" height="100%">
                    <b style="font-size: x-large;">Geoshop</b>
                </a>
            </div>
            <div class="d-inline-flex ms-auto align-items-center" style="justify-content: flex-end; margin-right: 2%;">
                <div class="dropdown">
                    <button class="btn bg-transparent dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M4 6H20M4 12H20M4 18H20" stroke="#000000" stroke-width="0.9600000000000002" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                    </button>
                    <div class="dropdown-menu">
                        <li><a href="userMap.php" class="dropdown-item">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g id="Navigation / Map_Pin">
                                            <g id="Vector">
                                                <path d="M5 9.92285C5 14.7747 9.24448 18.7869 11.1232 20.3252C11.3921 20.5454 11.5281 20.6568 11.7287 20.7132C11.8849 20.7572 12.1148 20.7572 12.271 20.7132C12.472 20.6567 12.6071 20.5463 12.877 20.3254C14.7557 18.7871 18.9999 14.7751 18.9999 9.9233C18.9999 8.08718 18.2625 6.32605 16.9497 5.02772C15.637 3.72939 13.8566 3 12.0001 3C10.1436 3 8.36301 3.7295 7.05025 5.02783C5.7375 6.32616 5 8.08674 5 9.92285Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M10 9C10 10.1046 10.8954 11 12 11C13.1046 11 14 10.1046 14 9C14 7.89543 13.1046 7 12 7C10.8954 7 10 7.89543 10 9Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                Map
                            </a></li>
                        <li><a href="../php/logout.php" class="dropdown-item">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M21 12L13 12" stroke="#323232" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M18 15L20.913 12.087V12.087C20.961 12.039 20.961 11.961 20.913 11.913V11.913L18 9" stroke="#323232" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M16 5V4.5V4.5C16 3.67157 15.3284 3 14.5 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H14.5C15.3284 21 16 20.3284 16 19.5V19.5V19" stroke="#323232" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                                Logout
                            </a></li>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="d-flex flex-column flex-md-row">
            <div class="container m-4" style="background-color: #F6F4EB;">
                <h1>Cart Items</h1>
                <ul class="list-group">
                    <?php
                    $total_price = 0;
                    foreach ($_SESSION['cart'] as $item) :
                        $total_price += $item['productPrice'];
                    ?>
                        <li class="list-group-item">
                            <div class="d-flex flex-row">
                                <div>
                                    <img src="<?php echo $item['productPhoto']; ?>" alt="Product Photo" width="100vw" height="100vh" class="rounded">
                                </div>
                                <div class="ms-4">
                                    <p class="fs-3"><?php echo $item['productName']; ?></p>
                                    <p class="fs-6">IDR. <?php echo number_format($item['productPrice']); ?></p>
                                </div>
                            </div>
                        </li>
                    <?php endforeach;
                    $_SESSION['total'] = $total_price; ?>
                    <form action="" method="post">

                    </form>
                </ul>
            </div>
            <?php
            require_once "../php/config.php";

            $sql = "INSERT INTO transactions (price, transaction_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $transaction_id = mt_rand(1000000000, 2147483647);
            $stmt->bind_param("ss", $total_price, $transaction_id);
            $stmt->execute();

            $sql = "SELECT * FROM transactions WHERE transaction_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $transaction_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            ?>
            <div class="container m-4">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card mx-auto my-5">
                            <div class="card-header" style="background-color: #F6F4EB;">
                                <h5 class="card-title mb-0">Transaction Details</h5>
                            </div>
                            <div class="card-body" style="background-color: #F6F4EB;">
                                <p class="card-text">Transaction ID: <?php echo $row['transaction_id'] ?></p>
                                <p class="card-text">Total Price: IDR. <?php echo number_format($row['price']) ?></p>
                                <p class="card-text">Payment Datetime: <?php if ($row['payment_datetime'] != null) {
                                                                            echo date("Y-m-d H:i:s", strtotime($row['payment_time']));
                                                                        } else {
                                                                            echo "N/A";
                                                                        } ?></p>
                                <p class="card-text">Confirmation Datetime: <?php if ($row['confirmation_datetime'] != null) {
                                                                                echo date("Y-m-d H:i:s", strtotime($row['confirmation_datetime']));
                                                                            } else {
                                                                                echo "N/A";
                                                                            } ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
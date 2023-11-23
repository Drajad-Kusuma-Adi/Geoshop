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
        <div class="d-flex flex-column flex-md-row">
            <div class="container m-4" style="background-color: #F6F4EB;">
                <h1>Cart Items</h1>
                <ul class="list-group">
                    <form action="../php/confirmPurchase.php" method="POST">
                        <?php
                        $total_price = 0;
                        $counter = 1;

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
                                        <input type="hidden" name="itemId<?php echo $counter; ?>" value="<?php echo $item['productId']; ?>">
                                        <input type="hidden" name="shop<?php echo $counter; ?>" value="<?php echo $item['productShop']; ?>">
                                    </div>
                                </div>
                            </li>
                        <?php
                            $counter++;
                        endforeach;
                        $_SESSION['total'] = $total_price; ?>
                        <?php
                        require_once "../php/config.php";
                        $sql = "SELECT * FROM transactions WHERE customer_id = ? AND confirmation_datetime = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ss", $_SESSION["userId"], $null);
                        $null = null;
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                        ?>
                            <input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>">
                            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
                            <div class="my-2">
                                <button><a href="../php/cancelTransaction.php">Cancel Transaction</a></button>
                            </div>
                    </form>
                </ul>
            </div>
            <div class="container m-4">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card mx-auto my-5">
                            <div class="card-header" style="background-color: #F6F4EB;">
                                <h5 class="card-title mb-0">Transaction Details</h5>
                            </div>
                            <div class="card-body" style="background-color: #F6F4EB;">
                                <p class="card-text">Transaction ID: <?php
                                                                        if (isset($row)) {
                                                                            echo $row['transaction_id'];
                                                                        }
                                                                        ?></p>
                                <p class="card-text">Total Price: IDR. <?php
                                                                        if (isset($row)) {
                                                                            echo number_format($row['price']);
                                                                        }
                                                                        ?></p>
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
        <?php } else { ?>
            <input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>">
            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
            <div class="my-2">
                <button><input type="submit" value="Confirm Purchase"></button>
            </div>
            </form>
            </ul>
        </div>
    <?php } ?>
    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- $sql = "SELECT stock FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $productId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$previousStock = $row['stock'];
$currentStock = $previousStock - 1;

$sql = "UPDATE products SET stock = ? WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $currentStock, $productId);
$stmt->execute(); -->
</body>

</html>
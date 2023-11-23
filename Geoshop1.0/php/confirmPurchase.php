<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about:blank</title>
</head>

<body>
    <form action="" id="form" method="POST">
        <input type="hidden" name="customerLatitude" id="customerLatitude">
        <input type="hidden" name="customerLongitude" id="customerLongitude">
        <input type="hidden" name="transaction_id" id="transaction_id">
        <input type="hidden" name="total_price" id="total_price">
        <input type="submit" id="submit" value="Submit" hidden>
    </form>
    <script>
        let watchId;
        let userPosition = {
            latitude: null,
            longitude: null
        };

        (() => {
            if (navigator.geolocation) {
                watchId = navigator.geolocation.watchPosition(geoSuccess, geoError, {
                    enableHighAccuracy: true,
                    maximumAge: 0,
                    timeout: 10000
                });
            } else {
                alert("Geolocation is not supported by this browser");
            }
        })();

        function geoSuccess(position) {
            userPosition.latitude = position.coords.latitude;
            userPosition.longitude = position.coords.longitude;

            let customerLatitudeInput = document.getElementById('customerLatitude');
            let customerLongitudeInput = document.getElementById('customerLongitude');
            let transactionIdInput = document.getElementById('transaction_id');
            let totalPriceInput = document.getElementById('total_price');

            let customerLatitudeValue = userPosition.latitude;
            let customerLongitudeValue = userPosition.longitude;
            let transactionIdValue = <?php echo $_POST['transaction_id']; ?>;
            let totalPriceValue = <?php echo $_POST['total_price']; ?>;

            customerLatitudeInput.setAttribute('value', customerLatitudeValue);
            customerLongitudeInput.setAttribute('value', customerLongitudeValue);
            transactionIdInput.setAttribute('value', transactionIdValue);
            totalPriceInput.setAttribute('value', totalPriceValue);

            let previousPage = document.referrer;
            if (previousPage !== "confirmPurchase.php") {
                document.getElementById('submit').click();
            } else {
                <?php
                require_once "config.php";

                $customerLatitude = $_POST['customerLatitude'];
                $customerLongitude = $_POST['customerLongitude'];
                $transaction_id = $_POST['transaction_id'];
                $total_price = $_POST['total_price'];

                $_SESSION['transactionId'] = $transaction_id;
                $_SESSION['totalPrice'] = $total_price;

                $products = [];
                foreach ($_POST as $name => $value) {
                    if (strpos($name, 'itemId') !== false) {
                        $productId = str_replace('itemId', '', $name);
                        $products['product' . $productId] = $value;
                    }
                }

                $shops = [];
                foreach ($_POST as $name => $value) {
                    if (strpos($name, 'shop') !== false) {
                        $shopId = str_replace('shop', '', $name);
                        $shops['shop' . $shopId] = $value;
                    }
                }

                $categorizedProducts = [];
                foreach ($products as $key => $value) {
                    $sql = "SELECT shop_id FROM products WHERE product_id=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $value);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();

                    if (in_array($row['shop_id'], $shops)) {
                        if (!isset($categorizedProducts[$row['shop_id']])) {
                            $categorizedProducts[$row['shop_id']] = [];
                        }
                        $categorizedProducts[$row['shop_id']][] = $value;
                    }
                }

                $categorizedProductsJson = json_encode($categorizedProducts);

                $sql = "INSERT INTO transactions (transaction_id, price, shop_id, customer_id, products) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $value1, $value2, $value3json, $value4, $value5json);
                $value1 = $transaction_id;
                $value2 = $total_price;
                $value3 = array_keys($categorizedProducts);
                $value3json = json_encode($value3);
                $value4 = $_SESSION['userId'];
                $value5 = array_values($categorizedProducts);
                $value5json = json_encode($value5);
                $stmt->execute();

                header("Location: ../user/cart.php");
                ?>
            }
        }

        function geoError() {
            alert("Unable to retrieve location");
            window.history.back();
        }
    </script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</body>

</html>
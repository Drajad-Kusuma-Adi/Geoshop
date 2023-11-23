<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: #FFFFFF;
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
        <?php
        require_once "../php/config.php";
        $productId = $_GET['productId'];

        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $productId = $row['product_id'];
        $productName = $row["product_name"];
        $productPrice = $row["price"];
        $productDescription = $row["description"];
        $productPhoto = $row["photo"];
        $productStock = $row["stock"];
        ?>
        <div class="container-fluid d-flex flex-md-row flex-column mt-2">
            <div class="d-flex flex-column p-4 col-md-8 col-12 me-1 mb-1" style="background-color: #F1F1F1;">
                <div class="text-start mb-4">
                    <a href="shopView.php?shopId=<?php echo $_SESSION['shopId'] ?>&userLatitude=<?php echo $_SESSION['userLatitude'] ?>&userLongitude=<?php echo $_SESSION['userLongitude'] ?>" class="text-decoration-none">
                        <svg width="36px" height="36px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill="#000000" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path>
                                <path fill="#000000" d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"></path>
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="d-flex flex-column align-items-start justify-content-center">
                    <img src="<?php if ($productPhoto != null) {
                                    echo $productPhoto;
                                } else {
                                    echo "../images/blankProduct.png";
                                } ?>" alt="Product Photo" width="25%" height="auto">
                    <p class="fs-2 fw-bold"><?php echo $productName ?></p>
                    <p class="fs-3 fw-bold">IDR. <?php echo number_format($productPrice) ?></p>
                    <p><?php echo $productDescription ?></p>
                </div>
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <form action="../php/addToCart.php" method="post">
                        <input type="text" name="itemId" id="itemId" hidden value="<?php echo $productId ?>">
                        <input type="text" name="itemName" id="itemName" hidden value="<?php echo $productName ?>">
                        <input type="text" name="itemPrice" id="itemPrice" hidden value="<?php echo $productPrice ?>">
                        <input type="text" name="itemPhoto" id="itemPhoto" hidden value="<?php echo $productPhoto ?>">
                        <input type="text" name="itemVendor" id="itemVendor" hidden value="<?php echo $_SESSION['shopName'] ?>">
                        <div class="d-flex flex-column align-items-center">
                            <input type="submit" name="addToCart" id="addToCart" value="Add to cart" class="btn btn-primary fs-2 fw-bold" <?php if ($productStock == 0) {
                                                                                                                                                echo ' disabled';
                                                                                                                                            } ?>>
                            <p>Remaining stock: <?php echo $productStock ?></p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex flex-column p-4 col-md-4 col-12 mb-2 ms-1 mt-1" style="background: #F1F1F1">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row flex-nowrap">
                        <form action="../php/postComment.php?productId=<?php echo $_GET['productId']; ?>" method="post">
                            <div class="d-flex flex-row align-items-center">
                                <img src="<?php
                                            if (isset($_SESSION['profilePicture']) && file_exists("../profilePicture/" . $_SESSION['profilePicture'])) {
                                                echo "../profilePicture/" . $_SESSION['profilePicture'];
                                            } else {
                                                echo "../profilePicture/blankUser.jpg";
                                            } ?>" alt="Profile Picture" width="48" height="48" class="mx-2 rounded-circle">
                                <textarea name="typeCommentBox" id="typeCommentBox" placeholder="Enter your comment" class="mx-2 p-2 rounded" style="resize: none;"></textarea>
                            </div>
                            <div class="btn btn-secondary rounded-pill w-100 mx-2 my-2">
                                <label style="cursor: pointer;">
                                    <svg fill="#ffffff" width="24px" height="24px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <title>paper-plane</title>
                                            <path d="M0 14.016l9.216 6.912 18.784-16.928-14.592 20.064 10.592 7.936 8-32zM8 32l6.016-4-6.016-4v8z"></path>
                                        </g>
                                    </svg>
                                    <input type="submit" value="" style="display: none;">
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="m-2">
                            <form action="../php/sendLike.php?userId=<?php echo $_SESSION['userId'] ?>&productId=<?php echo $_GET['productId']; ?>" method="post">
                                <label style="cursor: pointer;">
                                    <svg width="36px" height="36px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.9 4.5C15.9 3 14.418 2 13.26 2c-.806 0-.869.612-.993 1.82-.055.53-.121 1.174-.267 1.93-.386 2.002-1.72 4.56-2.996 5.325V17C9 19.25 9.75 20 13 20h3.773c2.176 0 2.703-1.433 2.899-1.964l.013-.036c.114-.306.358-.547.638-.82.31-.306.664-.653.927-1.18.311-.623.27-1.177.233-1.67-.023-.299-.044-.575.017-.83.064-.27.146-.475.225-.671.143-.356.275-.686.275-1.329 0-1.5-.748-2.498-2.315-2.498H15.5S15.9 6 15.9 4.5zM5.5 10A1.5 1.5 0 0 0 4 11.5v7a1.5 1.5 0 0 0 3 0v-7A1.5 1.5 0 0 0 5.5 10z" fill="#<?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $sql = "SELECT * FROM product_likes WHERE user_id=? AND product_id=?";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $stmt = $conn->prepare($sql);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $stmt->bind_param("ss", $userId, $productId);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $stmt->execute();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $result = $stmt->get_result();

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        if ($result->num_rows > 0) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "0000FF";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } else if ($result->num_rows == 0) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "000000";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ?>"></path>
                                        </g>
                                    </svg>
                                    <input type="submit" value="" style="display: none;">
                                </label>
                                <span><?php echo $result->num_rows; ?></span>
                            </form>
                        </div>
                        <div class="m-2">
                            <form action="../php/sendDislike.php?userId=<?php echo $_SESSION['userId'] ?>&productId=<?php echo $_GET['productId']; ?>" method="post">
                                <label style="cursor: pointer;">
                                    <svg width="36px" height="36px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)matrix(1, 0, 0, 1, 0, 0)">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.1 20.5c0 1.5 1.482 2.5 2.64 2.5.806 0 .869-.613.993-1.82.055-.53.121-1.174.267-1.93.386-2.002 1.72-4.56 2.996-5.325V8C15 5.75 14.25 5 11 5H7.227C5.051 5 4.524 6.432 4.328 6.964A15.85 15.85 0 0 1 4.315 7c-.114.306-.358.546-.638.82-.31.306-.664.653-.927 1.18-.311.623-.27 1.177-.233 1.67.023.299.044.575-.017.83-.064.27-.146.475-.225.671-.143.356-.275.686-.275 1.329 0 1.5.748 2.498 2.315 2.498H8.5S8.1 19 8.1 20.5zM18.5 15a1.5 1.5 0 0 0 1.5-1.5v-7a1.5 1.5 0 0 0-3 0v7a1.5 1.5 0 0 0 1.5 1.5z" fill="#<?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $sql = "SELECT * FROM product_dislikes WHERE user_id=? AND product_id=?";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $stmt = $conn->prepare($sql);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $stmt->bind_param("ss", $userId, $productId);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $stmt->execute();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $result = $stmt->get_result();

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if ($result->num_rows > 0) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "0000FF";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } else if ($result->num_rows == 0) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "000000";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ?>"></path>
                                        </g>
                                    </svg>
                                    <input type="submit" value="" style="display: none;">
                                </label>
                                <span><?php echo $result->num_rows; ?></span>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex flex-column" style="overflow-y: scroll;">
                        <?php
                        // Get comments data from database
                        $sql = "SELECT * FROM product_comments WHERE product_id=? AND user_id=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ss", $value1, $value2);
                        $value1 = $_GET['productId'];
                        $value2 = $_SESSION['userId'];
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_all(MYSQLI_ASSOC);

                        // Initialize user comments
                        $userComments = array();

                        // Filter all comments by current user
                        foreach ($row as $comment) {
                            if ($comment['user_id'] == $_SESSION['userId']) {
                                $userComments[] = $comment;
                            }
                        }

                        // Output comments by current user
                        foreach ($userComments as $comment) {
                            $sql = "SELECT * FROM users WHERE user_id=?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $comment["user_id"]);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();

                            $comment["username"] = $row["username"];
                            $comment["photo"] = $row["photo"];
                        ?>
                            <div class="d-flex flex-row flex-nowrap m-2">
                                <div class="d-flex flex-row align-items-center">
                                    <img src="<?php
                                                if (isset($comment["photo"]) && file_exists("../profilePicture/" . $comment["photo"])) {
                                                    echo "../profilePicture/" . $comment["photo"];
                                                } else {
                                                    echo "../profilePicture/blankUser.jpg";
                                                } ?>" alt="Profile Picture" width="48" height="48" class="mx-2 rounded-circle">
                                    <div class="mx-2 p-2 rounded" readonly style="resize: none;">
                                        <span class="fw-bold"><?php echo $comment["username"]; ?> says:</span>
                                        <?php echo $comment["content"]; ?>
                                    </div>
                                </div>
                            </div>
                        <?php }

                        // Get comments data from database
                        $sql = "SELECT * FROM product_comments WHERE product_id=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $value1);
                        $value1 = $_GET['productId'];
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_all(MYSQLI_ASSOC);

                        // Initialize other user comments
                        $otherUserComments = array();

                        // Filter all comments by other users
                        foreach ($row as $comment) {
                            if ($comment['user_id'] !== $_SESSION['userId']) {
                                $otherUserComments[] = $comment;
                            }
                        }

                        // Output comments by other users
                        foreach ($otherUserComments as $comment) {
                            $sql = "SELECT * FROM users WHERE user_id=?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $comment["user_id"]);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();

                            $comment["username"] = $row["username"];
                            $comment["photo"] = $row["photo"];
                        ?>
                            <div class="d-flex flex-row flex-nowrap m-2">
                                <div class="d-flex flex-row align-items-center">
                                    <img src="<?php
                                                if (isset($comment["photo"]) && file_exists("../profilePicture/" . $comment["photo"])) {
                                                    echo "../profilePicture/" . $comment["photo"];
                                                } else {
                                                    echo "../profilePicture/blankUser.jpg";
                                                } ?>" alt="Profile Picture" width="48" height="48" class="mx-2 rounded-circle">
                                    <div class="mx-2 p-2 rounded" readonly style="resize: none;">
                                        <span class="fw-bold"><?php echo $comment["username"]; ?> says:</span>
                                        <?php echo $comment["content"]; ?>
                                    </div>
                                </div>
                            </div>
                        <?php }

                        $stmt->close();
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once "../footer.php"; ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
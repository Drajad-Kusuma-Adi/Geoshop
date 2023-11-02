<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop View</title>
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
        <div class="container-fluid">
            <div class="d-flex flex-column mt-4" style="background-color: #F6F4EB;">
                <div class="d-flex flex-column justify-content-between mx-3 mt-3 mb-0 p-3" style="border: 1px solid #000000; border-radius: 10px;">
                    <div class="d-flex flex-row">
                        <img src="../images/blankShop.png" alt="Shop Image" class="rounded-circle me-2" width="80" height="80">
                        <div class="d-flex flex-column">
                            <div class="fs-4 fw-bold"><?php echo $_SESSION['shopName'] ?></div>
                            <div class="fs-4">Owner: <?php
                                                        require_once "../php/config.php";
                                                        $sql = "SELECT * FROM users WHERE user_id = ?";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->bind_param("s", $value1);
                                                        $value1 = $_SESSION['ownerId'];
                                                        $stmt->execute();
                                                        $result = $stmt->get_result();
                                                        $row = $result->fetch_assoc();

                                                        echo $row['username'];
                                                        ?></div>
                            <div class="fs-6">Approximately <?php
                                                            $shopLatitude = $_SESSION['shopLatitude'];
                                                            $shopLongitude = $_SESSION['shopLongitude'];
                                                            $userLatitude = $_COOKIE['latitude'];
                                                            $userLongitude = $_COOKIE['longitude'];
                                                            $earthRadius = 6371;
                                                            $latitudeDistance = deg2rad($userLatitude - $shopLatitude);
                                                            $longitudeDistance = deg2rad($userLongitude - $shopLongitude);
                                                            $haversineValue = sin($latitudeDistance / 2) * sin($latitudeDistance / 2) + cos(deg2rad($shopLatitude)) * cos(deg2rad($userLatitude)) * sin($longitudeDistance / 2) * sin($longitudeDistance / 2);
                                                            $distanceRadians = 2 * atan2(sqrt($haversineValue), sqrt(1 - $haversineValue));
                                                            $distanceKm = $earthRadius * $distanceRadians;
                                                            $distanceMeter = $distanceKm * 1000;
                                                            echo round($distanceMeter);
                                                            ?> meter from your location</div>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-end ">
                        <a href="#" class="btn btn-secondary my-1 mx-1 align-self-end"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M17 3.33782C15.5291 2.48697 13.8214 2 12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04346 16.4525C3.22094 16.8088 3.28001 17.2161 3.17712 17.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L6.39939 20.8229C6.78393 20.72 7.19121 20.7791 7.54753 20.9565C8.88837 21.6244 10.4003 22 12 22C17.5228 22 22 17.5228 22 12C22 10.1786 21.513 8.47087 20.6622 7" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path d="M8 12H8.009M11.991 12H12M15.991 12H16" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg> Chat</a>
                        <a href="#" class="btn btn-secondary my-1 mx-1 align-self-end"><svg fill="#ffffff" width="24px" height="24px" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" stroke="#ffffff" stroke-width="0.00064">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <rect id="Icons" x="-640" y="-64" width="1280" height="800" style="fill:none;"></rect>
                                    <g id="Icons1" serif:id="Icons">
                                        <g id="Strike"> </g>
                                        <g id="H1"> </g>
                                        <g id="H2"> </g>
                                        <g id="H3"> </g>
                                        <g id="list-ul"> </g>
                                        <g id="hamburger-1"> </g>
                                        <g id="hamburger-2"> </g>
                                        <g id="list-ol"> </g>
                                        <g id="list-task"> </g>
                                        <g id="trash"> </g>
                                        <g id="vertical-menu"> </g>
                                        <g id="horizontal-menu"> </g>
                                        <g id="sidebar-2"> </g>
                                        <g id="Pen"> </g>
                                        <g id="Pen1" serif:id="Pen"> </g>
                                        <g id="clock"> </g>
                                        <g id="external-link"> </g>
                                        <g id="hr"> </g>
                                        <g id="info"> </g>
                                        <g id="warning">
                                            <path d="M32.427,7.987c2.183,0.124 4,1.165 5.096,3.281l17.936,36.208c1.739,3.66 -0.954,8.585 -5.373,8.656l-36.119,0c-4.022,-0.064 -7.322,-4.631 -5.352,-8.696l18.271,-36.207c0.342,-0.65 0.498,-0.838 0.793,-1.179c1.186,-1.375 2.483,-2.111 4.748,-2.063Zm-0.295,3.997c-0.687,0.034 -1.316,0.419 -1.659,1.017c-6.312,11.979 -12.397,24.081 -18.301,36.267c-0.546,1.225 0.391,2.797 1.762,2.863c12.06,0.195 24.125,0.195 36.185,0c1.325,-0.064 2.321,-1.584 1.769,-2.85c-5.793,-12.184 -11.765,-24.286 -17.966,-36.267c-0.366,-0.651 -0.903,-1.042 -1.79,-1.03Z" style="fill-rule:nonzero;"></path>
                                            <path d="M33.631,40.581l-3.348,0l-0.368,-16.449l4.1,0l-0.384,16.449Zm-3.828,5.03c0,-0.609 0.197,-1.113 0.592,-1.514c0.396,-0.4 0.935,-0.601 1.618,-0.601c0.684,0 1.223,0.201 1.618,0.601c0.395,0.401 0.593,0.905 0.593,1.514c0,0.587 -0.193,1.078 -0.577,1.473c-0.385,0.395 -0.929,0.593 -1.634,0.593c-0.705,0 -1.249,-0.198 -1.634,-0.593c-0.384,-0.395 -0.576,-0.886 -0.576,-1.473Z" style="fill-rule:nonzero;"></path>
                                        </g>
                                        <g id="plus-circle"> </g>
                                        <g id="minus-circle"> </g>
                                        <g id="vue"> </g>
                                        <g id="cog"> </g>
                                        <g id="logo"> </g>
                                        <g id="radio-check"> </g>
                                        <g id="eye-slash"> </g>
                                        <g id="eye"> </g>
                                        <g id="toggle-off"> </g>
                                        <g id="shredder"> </g>
                                        <g id="spinner--loading--dots-" serif:id="spinner [loading, dots]"> </g>
                                        <g id="react"> </g>
                                        <g id="check-selected"> </g>
                                        <g id="turn-off"> </g>
                                        <g id="code-block"> </g>
                                        <g id="user"> </g>
                                        <g id="coffee-bean"> </g>
                                        <g id="coffee-beans">
                                            <g id="coffee-bean1" serif:id="coffee-bean"> </g>
                                        </g>
                                        <g id="coffee-bean-filled"> </g>
                                        <g id="coffee-beans-filled">
                                            <g id="coffee-bean2" serif:id="coffee-bean"> </g>
                                        </g>
                                        <g id="clipboard"> </g>
                                        <g id="clipboard-paste"> </g>
                                        <g id="clipboard-copy"> </g>
                                        <g id="Layer1"> </g>
                                    </g>
                                </g>
                            </svg> Report</a>
                    </div>
                </div>
                <div class="d-flex flex-row m-3">
                    <div class="text-start">
                        <form action="" method="post">
                            <div class="bg-white p-1 rounded-pill border border-2">
                                <label style="cursor: pointer;">
                                    <input type="submit" value="" style="display: none;">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </label>
                                |
                                <input type="text" name="searchQuery" id="searchQuery" style="background-color: transparent; border: 0;" placeholder="Search this shop">
                            </div>
                        </form>
                        <?php
                        // require_once "php/config.php";
                        // if (isset($_POST["searchQuery"])) {

                        // }
                        ?>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-center flex-wrap m-3">
                    <div class="d-flex flex-column m-2 rounded-3" style="background-color: white;">
                        <img src="../images/blankShop.png" alt="Product Image" width="100" height="100" class="align-self-center m-4">
                        <div class="d-flex flex-column justify-content-between m-4" style="height: 100%;">
                            <div>
                                <p class="fs-2 fw-bold">Product Name</p>
                                <p class="fs-4">Pricing</p>
                            </div>
                        </div>
                        <a href="#" class="bg-primary text-center fs-3 fw-bold px-4 py-2 rounded-3" style="color: white; width: 100%;">Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
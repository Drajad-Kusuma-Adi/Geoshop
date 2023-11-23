<?php
$currentUrl = $_SERVER['REQUEST_URI']
?>
<header style="background-color: #F1F1F1;" class="mb-4">
    <div class="container-fluid p-1 d-inline-flex shadow">
        <div class="float-start" style="margin-left: 2%;">
            <div>
                <img src="../images/GeoshopLogo.png" alt="Geoshop Logo" width="25%" height="100%">
                <span class="fs-5 fw-bold">Geoshop</span>
            </div>
        </div>
        <div class="d-inline-flex ms-auto align-items-center" style="justify-content: flex-end; margin-right: 2%;">
            <?php
            if (isset($_GET["isGuest"]) && $_GET["isGuest"] == 1) {
                echo '
                    <div class="d-flex ms-auto align-items-center">
                        <a href="../loginPage.php" class="me-2">Login</a>
                        <a href="../loginPage.php">
                            <img src="../profilePicture/blankUser.jpg" alt="Guest" class="rounded-circle" width="32" height="32">
                        </a>
                    </div>
                    ';
            } else {
            ?>
                <?php
                if (strpos($currentUrl, "userProfile.php") == false) {
                    echo '
    <img src="../profilePicture/';
                    if (isset($_SESSION["profilePicture"]) && $_SESSION["profilePicture"] != null && file_exists("../profilePicture/" . $_SESSION["profilePicture"])) {
                        echo $_SESSION["profilePicture"];
                    } else {
                        echo "blankUser.jpg";
                    }
                    echo '" class="rounded-circle img-fluid" alt="Profile Picture" id="profilePicture" style="width: 32px; height: 32px;">
    ';
                } else {
                    echo '
                    <a href="userMap.php" style="text-decoration: none; color:black;">
                        <svg width="36px" height="36px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill="#000000" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path>
                                <path fill="#000000" d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"></path>
                            </g>
                        </svg>
                    </a>
                ';
                }
                ?>
                <?php
                if (strpos($currentUrl, "userProfile.php") == false) {
                ?>
                    <div class="dropdown">
                        <button class="btn bg-transparent dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="fs-4 fw-bold d-none d-lg-inline"><?php if (strpos($currentUrl, "userProfile.php") == false) {
                                                                                echo $_SESSION["username"];
                                                                            } ?></span>
                        </button>
                        <div class="dropdown-menu">
                            <li><a href="userMap.php" class="dropdown-item <?php
                                                                            if (strpos($currentUrl, "userMap.php") !== false) {
                                                                                echo "disabled";
                                                                            }
                                                                            ?>">
                                    <svg fill=" #000000" width="24px" height="24px" viewBox="-8 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <title>map-marker</title>
                                            <path d="M8.16 26.96c-0.88 0-1.64-0.4-2.040-1.080l-5.040-9c-0.68-1.16-1.080-2.52-1.080-3.92 0-4.36 3.68-7.92 8.16-7.92 4.52 0 8.16 3.56 8.16 7.92 0 1.4-0.4 2.76-1.12 3.96l-4.96 8.92c-0.44 0.72-1.2 1.12-2.080 1.12zM8.16 6.72c-3.56 0-6.48 2.8-6.48 6.24 0 1.080 0.28 2.16 0.88 3.12l5.040 8.96c0.080 0.16 0.32 0.24 0.6 0.24s0.52-0.12 0.6-0.28l5-8.92c0.56-0.96 0.88-2.040 0.88-3.12-0.040-3.44-2.92-6.24-6.52-6.24zM8.16 16.16c-1.64 0-2.96-1.36-2.96-2.96 0-1.64 1.32-2.96 2.96-2.96s2.96 1.32 2.96 2.96c0 1.6-1.32 2.96-2.96 2.96zM8.16 11.92c-0.72 0-1.28 0.56-1.28 1.28s0.56 1.28 1.28 1.28 1.28-0.56 1.28-1.28-0.56-1.28-1.28-1.28z"></path>
                                        </g>
                                    </svg>
                                    Map
                                </a></li>
                            <li><a href="userProfile.php" class="dropdown-item <?php
                                                                                if (strpos($currentUrl, "userProfile.php") !== false) {
                                                                                    echo "disabled";
                                                                                }
                                                                                ?>">
                                    <svg width=" 24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6C9.79086 6 8 7.79086 8 10C8 12.2091 9.79086 14 12 14C14.2091 14 16 12.2091 16 10C16 7.79086 14.2091 6 12 6Z" fill="#000000"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM4 12C4 7.58172 7.58172 4 12 4C16.4183 4 20 7.58172 20 12C20 14.0289 19.2447 15.8813 18.0001 17.2916C16.4085 15.8674 14.3052 15 12.0002 15C9.69511 15 7.5917 15.8675 6.00015 17.2918C4.75533 15.8815 4 14.029 4 12Z" fill="#000000"></path>
                                        </g>
                                    </svg>
                                    Profile
                                </a></li>
                            <li><a href="../chat.php" class="dropdown-item <?php
                                                                            if (strpos($currentUrl, "chat.php") !== false) {
                                                                                echo "disabled";
                                                                            }
                                                                            ?>">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M17 3.33782C15.5291 2.48697 13.8214 2 12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04346 16.4525C3.22094 16.8088 3.28001 17.2161 3.17712 17.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L6.39939 20.8229C6.78393 20.72 7.19121 20.7791 7.54753 20.9565C8.88837 21.6244 10.4003 22 12 22C17.5228 22 22 17.5228 22 12C22 10.1786 21.513 8.47087 20.6622 7" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path d="M8 12H8.009M11.991 12H12M15.991 12H16" stroke="#1C274C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                    Chat
                                </a></li>
                            <li><a href="cart.php" class="dropdown-item <?php
                                                                        if (strpos($currentUrl, "cart.php") !== false) {
                                                                            echo "disabled";
                                                                        }
                                                                        ?>">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <title>Shopping-cart</title>
                                            <g id="🖥-Landing" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="Artboard" transform="translate(-74.000000, -239.000000)">
                                                    <g id="Shopping-cart" transform="translate(74.000000, 239.000000)">
                                                        <rect id="Rectangle" x="0" y="0" width="24" height="24"> </rect>
                                                        <path d="M2.5,3.5 L4.57364,3.5 C4.81929,3.5 5.02855,3.67844 5.06736,3.921 L6.73058,14.3158 C6.88582,15.286 7.72287,15.9998 8.70546,15.9998 L17.3957,15.9998 C18.3331,15.9998 19.1447,15.3487 19.3481,14.4337 L20.7296,8.21674 C20.8684,7.59222 20.3932,6.9998 19.7534,6.9998 L5.83997,6.9998" id="Path" stroke="#0C0310" stroke-width="2" stroke-linecap="round"> </path>
                                                        <circle id="Oval" stroke="#0C0310" stroke-width="2" stroke-linecap="round" cx="9.5" cy="21" r="1"> </circle>
                                                        <circle id="Oval" stroke="#0C0310" stroke-width="2" stroke-linecap="round" cx="16.5" cy="21" r="1"> </circle>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    Cart
                                </a></li>
                            <?php
                            if ($_SESSION['isShop'] == true) {
                            ?>
                                <li><a href="orders.php" class="dropdown-item <?php
                                                                                if (strpos($currentUrl, "cart.php") !== false) {
                                                                                    echo "disabled";
                                                                                }
                                                                                ?>">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <title>Shopping-cart</title>
                                                <g id="🖥-Landing" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g id="Artboard" transform="translate(-74.000000, -239.000000)">
                                                        <g id="Shopping-cart" transform="translate(74.000000, 239.000000)">
                                                            <rect id="Rectangle" x="0" y="0" width="24" height="24"> </rect>
                                                            <path d="M2.5,3.5 L4.57364,3.5 C4.81929,3.5 5.02855,3.67844 5.06736,3.921 L6.73058,14.3158 C6.88582,15.286 7.72287,15.9998 8.70546,15.9998 L17.3957,15.9998 C18.3331,15.9998 19.1447,15.3487 19.3481,14.4337 L20.7296,8.21674 C20.8684,7.59222 20.3932,6.9998 19.7534,6.9998 L5.83997,6.9998" id="Path" stroke="#0C0310" stroke-width="2" stroke-linecap="round"> </path>
                                                            <circle id="Oval" stroke="#0C0310" stroke-width="2" stroke-linecap="round" cx="9.5" cy="21" r="1"> </circle>
                                                            <circle id="Oval" stroke="#0C0310" stroke-width="2" stroke-linecap="round" cx="16.5" cy="21" r="1"> </circle>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        Orders
                                    </a></li>
                            <?php } ?>
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
                    <?php } ?>
                <?php } ?>
                    </div>
        </div>
    </div>
    <div id="data" data-user-id="<?php echo $_SESSION['userId']; ?>"></div>
</header>
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        body {
            background-color: #ffffff;
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
        <div class="container-fluid p-1 d-inline-flex shadow" style="background-color: #F6F4EB;">
            <div class="float-start" style="margin-left: 2%;">
                <div>
                    <img src="../images/GeoshopLogo.png" alt="Geoshop Logo" width="25%" height="100%">
                    <b style="font-size: x-large;">Geoshop</b>
                </div>
            </div>
            <div class="d-inline-flex ms-auto align-items-center" style="justify-content: flex-end; margin-right: 2%;">
                <img src="profilePicture/<?php echo $_SESSION["profilePicture"]; ?>" class="rounded-circle img-fluid" alt="Profile Picture" id="profilePicture" width="7%" height="7%">
                <div class="dropdown">
                    <button class="btn bg-transparent dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fs-4 fw-bold"><?php echo $_SESSION["username"]; ?></span>
                    </button>
                    <div class="dropdown-menu">
                        <li><a href="userProfile.php" class="dropdown-item">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6C9.79086 6 8 7.79086 8 10C8 12.2091 9.79086 14 12 14C14.2091 14 16 12.2091 16 10C16 7.79086 14.2091 6 12 6Z" fill="#000000"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM4 12C4 7.58172 7.58172 4 12 4C16.4183 4 20 7.58172 20 12C20 14.0289 19.2447 15.8813 18.0001 17.2916C16.4085 15.8674 14.3052 15 12.0002 15C9.69511 15 7.5917 15.8675 6.00015 17.2918C4.75533 15.8815 4 14.029 4 12Z" fill="#000000"></path> </g></svg>
                            View profile
                        </a></li>
                        <li><a href="notifications.php" class="dropdown-item">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5.82474 13.934L5.09976 13.2452L5.82474 13.934ZM8 9C8 6.79086 9.79086 5 12 5V3C8.68629 3 6 5.68629 6 9H8ZM8 11.7564V9H6V11.7564H8ZM6 16C6 15.4658 6.20812 14.9823 6.54971 14.6228L5.09976 13.2452C4.41915 13.9616 4 14.9329 4 16H6ZM7 16H6V18H7V16ZM17 16H7V18H17V16ZM18 16H17V18H18V16ZM17.4503 14.6228C17.7919 14.9823 18 15.4658 18 16H20C20 14.9329 19.5809 13.9616 18.9002 13.2452L17.4503 14.6228ZM16 9V11.7564H18V9H16ZM12 5C14.2091 5 16 6.79086 16 9H18C18 5.68629 15.3137 3 12 3V5ZM18.9002 13.2452C18.2923 12.6054 18 12.1579 18 11.7564H16C16 13.05 16.8905 14.0336 17.4503 14.6228L18.9002 13.2452ZM4 16C4 17.1046 4.89543 18 6 18V16H4ZM18 18C19.1046 18 20 17.1046 20 16H18V18ZM6 11.7564C6 12.1579 5.70766 12.6054 5.09976 13.2452L6.54971 14.6228C7.10947 14.0336 8 13.05 8 11.7564H6Z" fill="#000000"></path> <path d="M13.7976 19.8767C13.6312 20.2179 13.3712 20.5046 13.048 20.7035C12.7247 20.9023 12.3516 21.0051 11.9721 20.9998C11.5926 20.9945 11.2224 20.8813 10.9049 20.6735C10.5873 20.4657 10.3354 20.1718 10.1786 19.8262" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 3V4" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            Notifications
                        </a></li>
                        <li><a href="../php/logout.php" class="dropdown-item">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 12L13 12" stroke="#323232" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M18 15L20.913 12.087V12.087C20.961 12.039 20.961 11.961 20.913 11.913V11.913L18 9" stroke="#323232" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M16 5V4.5V4.5C16 3.67157 15.3284 3 14.5 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H14.5C15.3284 21 16 20.3284 16 19.5V19.5V19" stroke="#323232" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            Logout
                        </a></li>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container d-flex flex-column" style="margin-top: 4%;">
            <div class="container d-flex flex-row">
                <img src="../images/blankShop.png" alt="Shop Profile" class="rounded-circle" width="10%" height="10%">
                <div class="d-flex flex-column">
                    <div class="fs-4 fw-bold">Shop</div>
                    <div class="fs-6">Owner: Owner</div>
                    <div class="fs-6">Approximately x meter from your location</div>
                </div>
            </div>
            <div class="container d-flex flex-row">

            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
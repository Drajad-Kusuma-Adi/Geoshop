<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 6H20M4 12H20M4 18H20" stroke="#000000" stroke-width="0.9600000000000002" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </button>
                    <div class="dropdown-menu">
                        <li><a href="userMap.php" class="dropdown-item">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Navigation / Map_Pin"> <g id="Vector"> <path d="M5 9.92285C5 14.7747 9.24448 18.7869 11.1232 20.3252C11.3921 20.5454 11.5281 20.6568 11.7287 20.7132C11.8849 20.7572 12.1148 20.7572 12.271 20.7132C12.472 20.6567 12.6071 20.5463 12.877 20.3254C14.7557 18.7871 18.9999 14.7751 18.9999 9.9233C18.9999 8.08718 18.2625 6.32605 16.9497 5.02772C15.637 3.72939 13.8566 3 12.0001 3C10.1436 3 8.36301 3.7295 7.05025 5.02783C5.7375 6.32616 5 8.08674 5 9.92285Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M10 9C10 10.1046 10.8954 11 12 11C13.1046 11 14 10.1046 14 9C14 7.89543 13.1046 7 12 7C10.8954 7 10 7.89543 10 9Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g> </g></svg>
                            Map
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
        <div class="container-fluid m-2">
            <div class="container">
                <div class="row my-2">
                    <p class="fs-2 fw-bold">Profile</p>
                    <div class="col rounded border p-2" style="background-color: #F6F4EB;">
                        <div class="d-flex justify-content-center w-100">
                            <img src="<?php if (isset($_SESSION['profilePicture'])) { echo "profilePicture/" . $_SESSION['profilePicture']; } else { echo "../images/blankUser.png"; }?>" class="rounded-circle img-fluid m-4" alt="Profile Picture" id="profilePicture" width="25%" height="25%">
                        </div>
                        <div class="d-flex justify-content-start flex-column w-100">
                            <p id="infoIcon" class="fs-4 fw-bold"><svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g id="Complete"> <g id="info-circle"> <g> <circle cx="12" cy="12" data-name="--Circle" fill="none" id="_--Circle" r="10" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle> <line fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12" x2="12" y1="12" y2="16"></line> <line fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12" x2="12" y1="8" y2="8"></line> </g> </g> </g> </g></svg> Info</p>
                            <p id="username"><span class="fs-4 fw-medium">Username: </span><?php echo $_SESSION['username'] ?></p>
                            <p id="email"><span class="fs-4 fw-medium">Email: </span><?php echo $_SESSION['email'] ?></p>
                        </div>
                        <div class="d-flex justify-content-end" id="editProfile">
                            <button type="button" class="btn btn-secondary m-1" data-bs-toggle="modal" data-bs-target="#editProfilePictureModal">Edit picture</button>
                            <button type="button" class="btn btn-secondary m-1" data-bs-toggle="modal" data-bs-target="#editProfileInfoModal">Edit profile</button>
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <p class="fs-2 fw-bold">Shop</p>
                    <div class="col rounded border p-2" style="background-color: #F6F4EB;">
                        <img src="../images/blankShop.png" alt="Shop Profile Picture" id="shopProfilePicture" width="19.5%" height="auto">
                        <div class="d-flex flex-column ms-4">
                            <?php
                            if ($_SESSION["isShop"] == 1) {
                                require_once "../php/getShopInfo.php";
                                // TODO: Yeah that doesn't work, fix this later plz
                            } else {
                                echo "<p><span class='fs-4 fw-medium'>Doesn't Own Shop</span></p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="editProfileInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="../php/editProfileInfo.php" method="post" enctype='multipart/form-data'>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="username" id="editUsernameLabel">
                                <span class="fs-4 fw-medium">Username: </span>
                            </label>
                            <input type="text" name="editUsername" id="editUsername" value="<?php echo $_SESSION['username'] ?>">
                        </div>
                        <br>
                        <div>
                            <label for="email" id="editEmailLabel">
                                <span class="fs-4 fw-medium">Email: </span>
                            </label>
                            <input type="email" name="editEmail" id="editEmail" value="<?php echo $_SESSION['email'] ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Save" class="btn btn-primary mx-1" id="saveEdit">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="editProfilePictureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="../php/editProfilePicture.php" method="post" enctype='multipart/form-data'>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit picture</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <input type="file" name="editProfilePicture" id="editProfilePicture">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Save" class="btn btn-primary mx-1" id="saveEdit">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
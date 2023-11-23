<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
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
    <?php require_once "../header.php" ?>
    <main>
        <div class="container-fluid m-2">
            <div class="container">
                <div class="row my-2">
                    <p class="fs-2 fw-bold">Profile</p>
                    <div class="col rounded border p-2" style="background-color: #F6F4EB;">
                        <div class="d-flex justify-content-center w-100">
                            <img src="<?php if (isset($_SESSION['profilePicture']) && file_exists("../profilePicture/" . $_SESSION["profilePicture"])) {
                                            echo "../profilePicture/" . $_SESSION['profilePicture'];
                                        } else {
                                            echo "../images/blankUser.png";
                                        } ?>" class="rounded-circle img-fluid m-4" alt="Profile Picture" id="profilePicture" style="width: 100px; height: 100px;">
                        </div>
                        <div class="d-flex justify-content-start flex-column w-100">
                            <p id="infoIcon" class="fs-4 fw-bold"><svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <title></title>
                                        <g id="Complete">
                                            <g id="info-circle">
                                                <g>
                                                    <circle cx="12" cy="12" data-name="--Circle" fill="none" id="_--Circle" r="10" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
                                                    <line fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12" x2="12" y1="12" y2="16"></line>
                                                    <line fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12" x2="12" y1="8" y2="8"></line>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg> Info</p>
                            <p id="username"><span class="fs-4 fw-medium">Username: </span><?php echo $_SESSION['username'] ?></p>
                            <p id="email"><span class="fs-4 fw-medium">Email: </span><?php echo $_SESSION['email'] ?></p>
                        </div>
                        <div class="d-flex justify-content-end" id="editProfile">
                            <form id="uploadForm" action="../php/editProfilePicture.php" method="POST" enctype="multipart/form-data">
                                <button type="button" id="uploadButton" class="btn btn-secondary m-1">
                                    Edit picture
                                </button>
                                <input type="file" name="editProfilePicture" id="editProfilePicture" style="display:none;">
                            </form>
                            <script>
                                const uploadButton = document.querySelector('#uploadButton');
                                const uploadInput = document.querySelector('#editProfilePicture');
                                uploadButton.addEventListener('click', () => {
                                    uploadInput.click();
                                });
                                uploadInput.addEventListener('change', () => {
                                    document.querySelector('#uploadForm').submit();
                                });
                            </script>
                            <button type="button" class="btn btn-secondary m-1" data-bs-toggle="modal" data-bs-target="#editProfileInfoModal">Edit profile</button>
                            <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteProfilePictureModal">Delete photo</button>
                            <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Delete account</button>
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <p class="fs-2 fw-bold">Shop</p>
                    <div class="col rounded border p-2" style="background-color: #F6F4EB;">
                        <div class="d-flex justify-content-center w-100">
                            <?php
                            if ($_SESSION["isShop"] == 1) {
                                require_once "../php/config.php";

                                $sql = "SELECT * FROM shops WHERE owner_id=?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $value1);
                                $value1 = $_SESSION["userId"];
                                $stmt->execute();

                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $_SESSION["shopId"] = $row["shop_id"];
                                $_SESSION["shopName"] = $row["shop_name"];
                                $_SESSION["ownerId"] = $row["owner_id"];
                                $_SESSION["shopPhoto"] = $row["photo"];
                                $_SESSION["shopLatitude"] = $row["latitude"];
                                $_SESSION["shopLongitude"] = $row["longitude"];

                                $stmt->close();
                                $conn->close();
                            }
                            ?>
                            <img src="<?php if (isset($_SESSION['assetPhoto']) && file_exists("../profilePicture/" . $_SESSION["assetPhoto"])) {
                                            echo "../profilePicture/" . $_SESSION['assetPhoto'];
                                        } else {
                                            echo "../images/blankShop.png";
                                        } ?>" class="rounded-circle img-fluid m-4" alt="Shop Profile Picture" id="shopProfilePicture" style="width: 100px; height: 100px;">
                        </div>
                        <div class="d-flex justify-content-start flex-column w-100">
                            <?php if ($_SESSION["isShop"] == 1) : ?>
                                <div class="d-flex justify-content-start flex-column w-100">
                                    <p id="infoIcon" class="fs-4 fw-bold"><svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <title></title>
                                                <g id="Complete">
                                                    <g id="info-circle">
                                                        <g>
                                                            <circle cx="12" cy="12" data-name="--Circle" fill="none" id="_--Circle" r="10" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
                                                            <line fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12" x2="12" y1="12" y2="16"></line>
                                                            <line fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12" x2="12" y1="8" y2="8"></line>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg> Info</p>
                                    <p id="shopName"><span class="fs-4 fw-medium">Shop Name: </span><?php echo $_SESSION["shopName"]; ?></p>
                                    <p id="shopLocation"><span class="fs-4 fw-medium">Shop Location: </span></p>
                                    <div id="map" style="width: 200px; height: 200px;">
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var shopLatitude = <?php echo $_SESSION["assetLatitude"]; ?>;
                                                var shopLongitude = <?php echo $_SESSION["assetLongitude"]; ?>;

                                                const map = L.map("map", {
                                                    zoomControl: false
                                                }).setView([shopLatitude, shopLongitude], 20);
                                                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);
                                                L.marker([shopLatitude, shopLongitude]).addTo(map);

                                                map.dragging.disable();
                                                map.touchZoom.disable();
                                                map.doubleClickZoom.disable();
                                                map.scrollWheelZoom.disable();
                                                map.boxZoom.disable();
                                                map.keyboard.disable();
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end" id="editProfileShop">
                                    <div class="dropdown dropup m-1">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Manage shop
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a href="manageProducts.php" class="dropdown-item">Manage products</a>
                                            </li>
                                        </div>
                                    </div>
                                    <div class="dropdown dropup m-1">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Manage shop info
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <form id="uploadFormShop" action="../php/editProfilePictureShop.php" method="POST" enctype="multipart/form-data">
                                                    <button type="button" id="uploadButtonShop" class="dropdown-item">
                                                        Edit picture
                                                    </button>
                                                    <input type="file" name="editProfilePictureShop" id="editProfilePictureShop" style="display:none;">
                                                </form>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editShopInfoModal">Edit shop</button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#removeShopPhotoModal">Delete photo</button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#removeShopModal">Delete shop (DANGER)</button>
                                            </li>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    const uploadButtonShop = document.querySelector('#uploadButtonShop');
                                    const uploadInputShop = document.querySelector('#editProfilePictureShop');
                                    uploadButtonShop.addEventListener('click', () => {
                                        uploadInputShop.click();
                                    });
                                    uploadInputShop.addEventListener('change', () => {
                                        document.querySelector('#uploadFormShop').submit();
                                    });
                                </script>
                        </div>
                    <?php else : ?>
                        <p class='fs-4 fw-medium text-center'>Doesn't own shop</p>
                        <div class='d-flex justify-content-center' id='registerShop'>
                            <a href='registerShop.php' class='btn btn-secondary m-1'>Register shop</a>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <div class="modal fade" id="editProfileInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
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
    <div class="modal fade" id="editShopInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-fullscreen">
            <form action="../php/editShopInfo.php" method="post" enctype='multipart/form-data'>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit shop info</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column me-2">
                                        <p class="text-center">Use this map to enter Longitude and Latitude data</p>
                                        <div id="editMap" style="height: 200px; justify-content: center;">
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    var shopLatitude = <?php echo $_SESSION["assetLatitude"]; ?>;
                                                    var shopLongitude = <?php echo $_SESSION["assetLongitude"]; ?>;

                                                    const editMap = L.map("editMap").setView([shopLatitude, shopLongitude], 20);
                                                    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(editMap);
                                                    L.marker([shopLatitude, shopLongitude]).addTo(editMap);
                                                    editMap.on('click', updateMarkerLocation());
                                                    map.on('click', updateMarkerLocation());

                                                    function updateMarkerLocation(e) {
                                                        map.on('click', function(e) {
                                                            let newLatitude = e.latlng.lat;
                                                            let newLongitude = e.latlng.lng;

                                                            shopLocationMarker.setLatLng([newLatitude, newLongitude]);
                                                            shopLocationMarker.bindPopup("Your shop is located at latitude " + newLatitude + " and longitude " + newLongitude + ".").openPopup();

                                                            document.getElementById('editLongitude').value = newLatitude;
                                                            document.getElementById('editLatitude').value = newLongitude;

                                                            if (previousMarker) {
                                                                map.removeLayer(previousMarker);
                                                            }

                                                            let clickedLat = e.latlng.lat;
                                                            let clickedLng = e.latlng.lng;

                                                            let clickedMarker = L.marker([clickedLat, clickedLng]).addTo(map);

                                                            clickedMarker.bindPopup("Your shop location is in: " + clickedLat + ", " + clickedLng).openPopup();

                                                            previousMarker = clickedMarker;

                                                            document.getElementById("editLongitude").value = clickedLng;
                                                            document.getElementById("editLatitude").value = clickedLat;
                                                        });
                                                    }
                                                    let previousEditShopMarker = null;
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-sm-12 col-md-6 me-2">
                                        <div>
                                            <div>
                                                <label for="shopName">
                                                    Shop name
                                                </label>
                                                <br>
                                                <input type="text" name="shopName" id="shopName" placeholder="Name your shop" class="p-2 rounded-4 w-75 mb-3" required value="<?php echo $_SESSION['assetName']; ?>">
                                            </div>
                                            <div>
                                                <label for="latitude">
                                                    Latitude
                                                </label>
                                                <br>
                                                <input type="text" name="latitude" id="editLatitude" placeholder="Use the map to fill this" class="p-2 rounded-4 w-75 mb-3" required readonly value="<?php echo $_SESSION["assetLatitude"]; ?>">
                                            </div>
                                            <div>
                                                <label for="longitude">
                                                    Longitude
                                                </label>
                                                <br>
                                                <input type="text" name="longitude" id="editLongitude" placeholder="Use the map to fill this" class="p-2 rounded-4 w-75 mb-3" required readonly value="<?php echo $_SESSION["assetLongitude"]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" value="Save" class="btn btn-primary mx-1" id="saveEdit">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
            </form>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
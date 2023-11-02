<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map View</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
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
                    <span class="fs-5 fw-bold">Geoshop</span>
                </div>
            </div>
            <div class="d-inline-flex ms-auto align-items-center" style="justify-content: flex-end; margin-right: 2%;">
                <img src="../profilePicture/<?php if (isset($_SESSION["profilePicture"]) && $_SESSION["profilePicture"] != null) {
                                                echo $_SESSION["profilePicture"];
                                            } else {
                                                echo "blankUser.jpg";
                                            } ?>" class="rounded-circle img-fluid" alt="Profile Picture" id="profilePicture" width="32px" height="32px">
                <div class="dropdown">
                    <button class="btn bg-transparent dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fs-4 fw-bold d-none d-lg-inline"><?php echo $_SESSION["username"]; ?></span>
                    </button>
                    <div class="dropdown-menu">
                        <li><a href="userProfile.php" class="dropdown-item">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6C9.79086 6 8 7.79086 8 10C8 12.2091 9.79086 14 12 14C14.2091 14 16 12.2091 16 10C16 7.79086 14.2091 6 12 6Z" fill="#000000"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM4 12C4 7.58172 7.58172 4 12 4C16.4183 4 20 7.58172 20 12C20 14.0289 19.2447 15.8813 18.0001 17.2916C16.4085 15.8674 14.3052 15 12.0002 15C9.69511 15 7.5917 15.8675 6.00015 17.2918C4.75533 15.8815 4 14.029 4 12Z" fill="#000000"></path>
                                    </g>
                                </svg>
                                Profile
                            </a></li>
                        <li><a href="../chat.php" class="dropdown-item">
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
        <div id="data" data-user-id="<?php echo $_SESSION['userId']; ?>"></div>
    </header>
    <main>
        <div id="map" class="container-fluid" style="height: 100vh;">
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

                console.log(userPosition);

                function geoSuccess(position) {
                    userPosition.latitude = position.coords.latitude;
                    userPosition.longitude = position.coords.longitude;
                    document.cookie = `latitude=${position.coords.latitude}; path=/`;
                    document.cookie = `longitude=${position.coords.longitude}; path=/`;

                    displayMap(userPosition.latitude, userPosition.longitude, 20);
                }

                function geoError() {
                    alert("Unable to retrieve location");
                }

                function displayMap(latitude, longitude, zoomLevel) {
                    const map = L.map("map").setView([latitude, longitude], zoomLevel);
                    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);
                    L.marker([latitude, longitude]).addTo(map);

                    let shopIcon = L.icon({
                        iconUrl: "../images/shopMarker.png",
                        iconSize: [20, 40]
                    });

                    const apiUrl = 'http://localhost/Geoshop/Geoshop%201.0/php/getShopLocation.php';
                    fetch(apiUrl)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            data.forEach(shop => {
                                let distance = calculateDistance(latitude, longitude, shop.latitude, shop.longitude);
                                let userId = document.getElementById('data').dataset.userId;
                                let shopOwnerId = shop.owner_id.toString();
                                console.log(typeof shopId);

                                if (distance <= 1) {
                                    if (shopOwnerId != userId) {
                                        let iconOptions = {
                                            title: shop.shop_name,
                                            draggable: false,
                                            icon: shopIcon
                                        }
                                        let shopId = shop.shop_id;
                                        let shopName = shop.shop_name;
                                        let shopPhoto = shop.shop_photo;
                                        let shopMarker = L.marker([shop.latitude, shop.longitude], iconOptions).addTo(map);
                                        shopMarker.bindPopup(
                                            `<div class="d-flex flex-row justify-content-center">
                                                <img src="${shopPhoto}" alt="Shop Photo" width="24" height="24">
                                                <div>
                                                    <div>${shopName}</div>
                                                    <div><a href="../php/getShopData.php?shopId=${shopId}">Click to view</a></div>
                                                </div>
                                            </div>`
                                        );
                                        shopMarker.on('click', function(e) {
                                            shopMarker.openPopup();
                                        });
                                    } else {
                                        let iconOptions = {
                                            title: shop.shop_name,
                                            draggable: false,
                                            icon: shopIcon
                                        }
                                        let selfMarker = L.marker([shop.latitude, shop.longitude], iconOptions).addTo(map);
                                        selfMarker.bindPopup(
                                            'You own this shop!'
                                        );
                                        selfMarker.on('click', function(e) {
                                            selfMarker.openPopup();
                                        });
                                    }
                                }
                            });
                        })
                        .catch(error => {
                            console.log("Error caused by: " + error);
                        });
                }

                function calculateDistance(latitude1, longitude1, latitude2, longitude2) {
                    if ((latitude1 == latitude2) && (longitude1 == longitude2)) {
                        return 0;
                    } else {
                        let radiusLatitude1 = Math.PI * latitude1 / 180;
                        let radiusLatitude2 = Math.PI * latitude2 / 180;
                        let theta = longitude1 - longitude2;
                        let radiusTheta = Math.PI * theta / 180;
                        let distance = Math.sin(radiusLatitude1) * Math.sin(radiusLatitude2) + Math.cos(radiusLatitude1) * Math.cos(radiusLatitude2) * Math.cos(radiusTheta);
                        if (distance > 1) {
                            distance = 1;
                        }
                        distance = Math.acos(distance);
                        distance = distance * 180 / Math.PI;
                        distance = distance * 60 * 1.1515 * 1.609344;
                        return distance;
                    }
                }
            </script>

        </div>
    </main>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
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
            background-image: url(../images/);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
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
            <div class="d-flex flex-row float-start" style="margin-left: 2%;">
                <a href="../index.php">
                    <img src="../images/GeoshopLogo.png" alt="Geoshop Logo" width="25%" height="100%">
                    <b style="font-size: x-large;">Geoshop</b>
                </a>
            </div>
            <div class="d-flex ms-auto align-items-center">
                <a href="../loginPage.php" class="me-2">Login</a>
                <a href="../loginPage.php">
                    <img src="../images/blankUser.png" alt="Guest" class="rounded-circle" width="40%" height="40%">
                </a>
            </div>
        </div>
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

                function geoSuccess(position) {
                    userPosition.latitude = position.coords.latitude;
                    userPosition.longitude = position.coords.longitude;

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
                                        let userLatitude = userPosition.latitude;
                                        let userLongitude = userPosition.longitude;
                                        let shopMarker = L.marker([shop.latitude, shop.longitude], iconOptions).addTo(map);
                                        shopMarker.bindPopup(
                                            `<div class="d-flex flex-row justify-content-center">
                                                <img src="${shopPhoto}" alt="" width="24" height="24">
                                                <div>
                                                    <div>${shopName}</div>
                                                    <div><a href="../php/getShopData.php?shopId=${shopId}&userLatitude=${userLatitude}&userLongitude=${userLongitude}">Click to view</a></div>
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
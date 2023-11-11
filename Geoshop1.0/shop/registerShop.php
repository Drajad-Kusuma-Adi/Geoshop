<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Shop</title>
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
    <main class="container d-flex justify-content-center align-items-center" style="margin-top: 5%;">
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <div class="row">
                <a href="../user/userMap.php">
                    <div class="text-center">
                        <img src="../images/GeoshopLogo.png" alt="Geoshop Logo" width="50%" height="auto">
                    </div>
                </a>
                <h1 class="fs-1 fw-bold text-center">Geoshop</h1>
                <p class="fs-4 fst-italic text-center">"Shop anywhere, anytime"</p>
            </div>
            <div class="row">
                <div class="d-flex flex-column flex-md-row">
                    <div class="float-start justify-content-center m-4" style="width: 90%;">
                        <p class="text-center">Use this map to enter Longitude and Latitude data</p>
                        <div id="map" style="width: 100%; height: 40vh; border: 1px solid black; border-radius: 30px;">
                            <script>
                                (() => {
                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition(success, error, {
                                            enableHighAccuracy: true,
                                            maximumAge: 0,
                                            timeout: 10000
                                        });
                                    } else {
                                        alert("Geolocation is not supported by this browser");
                                    }
                                })();

                                function success(position) {
                                    const accuracy = position.coords.accuracy;
                                    let latitude = position.coords.latitude;
                                    let longitude = position.coords.longitude;
                                    initializeMap(latitude, longitude);
                                }

                                function error() {
                                    alert("Unable to retrieve location");
                                }

                                let map;
                                let shopLocationMarker;

                                function initializeMap(latitude, longitude) {
                                    map = L.map("map").setView([latitude, longitude], 20);

                                    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);

                                    shopLocationMarker = L.marker([latitude, longitude]).addTo(map);
                                    shopLocationMarker.bindPopup("Your shop is located at latitude " + latitude + " and longitude " + longitude + ".").openPopup();

                                    document.getElementById('latitude').value = latitude;
                                    document.getElementById('longitude').value = longitude;

                                    map.on('click', updateMarkerLocation);
                                }

                                function updateMarkerLocation(e) {
                                    map.on('click', function(e) {
                                        let newLatitude = e.latlng.lat;
                                        let newLongitude = e.latlng.lng;

                                        shopLocationMarker.setLatLng([newLatitude, newLongitude]);
                                        shopLocationMarker.bindPopup("Your shop is located at latitude " + newLatitude + " and longitude " + newLongitude + ".").openPopup();

                                        document.getElementById('latitude').value = newLatitude;
                                        document.getElementById('longitude').value = newLongitude;

                                        if (previousMarker) {
                                            map.removeLayer(previousMarker);
                                        }

                                        let clickedLat = e.latlng.lat;
                                        let clickedLng = e.latlng.lng;

                                        let clickedMarker = L.marker([clickedLat, clickedLng]).addTo(map);

                                        clickedMarker.bindPopup("Your shop location is in: " + clickedLat + ", " + clickedLng).openPopup();

                                        previousMarker = clickedMarker;

                                        document.getElementById("longitude").value = clickedLng;
                                        document.getElementById("latitude").value = clickedLat;
                                    });
                                }

                                let previousMarker = null;
                            </script>
                        </div>
                    </div>
                    <div class="float-end justify-content-center m-4" style="width: 90%;">
                        <h2 class="text-center fs-2 fw-bold">Register Shop</h2>
                        <div class="container text-start shadow py-4" style="background-color: #F6F4EB;">
                            <div class="row text-center">
                                <form action="../php/registerShop.php" method="POST">
                                    <div>
                                        <label for="shopName">
                                            Shop name
                                        </label>
                                        <br>
                                        <input type="text" name="shopName" id="shopName" placeholder="Name your shop" class="p-2 rounded-4 w-75 mb-3" required>
                                    </div>
                                    <div>
                                        <label for="latitude">
                                            Latitude
                                        </label>
                                        <br>
                                        <input type="text" name="latitude" id="latitude" placeholder="Use the map to fill this" class="p-2 rounded-4 w-75 mb-3" required readonly>
                                    </div>
                                    <div>
                                        <label for="longitude">
                                            Longitude
                                        </label>
                                        <br>
                                        <input type="text" name="longitude" id="longitude" placeholder="Use the map to fill this" class="p-2 rounded-4 w-75 mb-3" required readonly>
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary mt-3 w-75" value="Register">
                                    </div>
                                </form>
                                <div class="text-center">
                                    <a href="../user/userProfile.php">
                                        <button type="button" class="btn btn-light mt-3 w-75">Cancel</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
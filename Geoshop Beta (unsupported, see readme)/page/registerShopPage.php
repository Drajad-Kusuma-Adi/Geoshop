<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Shop</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: black;
            background-image: url(../image/wavyCyanWhiteBackground.png);
            background-repeat: no-repeat;
            background-size: cover;
        }

        #map {
            width: 500px;
            height: 400px;
            border: 2px solid black;
            border-radius: 10px;
        }
        #mainHeader {
            display: fixed;
            padding: 10px;
            text-align: center;
            font-size: xx-large;
        }
        #navbar {
            width: fit-content;
        }
        #navbar a {
            text-decoration: none;
            color: white;
            font-size: smaller;
        }
        #registerShopContainer {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div id="mainContainer">
        <header>
            <div id="mainHeader">
                <!-- <div id="navbar" align="center">
                    <a href="../index.php">⬅️ Home</a>
                    <a href="loginPage.php">⬅️ Login</a>
                </div> -->
                <h2>Geoshop Register Shop</h2>
                <a href="userProfile.php">
                    <img src="../image/GeoshopLogo-removebg-preview.png" alt="Geoshop Logo" width="10%" height="10%">
                </a>
            </div>
        </header>
        <main>
            <table id="registerShopContainer" cellspacing="50">
                <tr>
                    <td>
                        <!-- Create a div element to hold the map -->
                        <div id="map">
                                <!-- Your JavaScript code will go here -->
                            <script>
                                let map = null;
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
                                    const latitude = position.coords.latitude;
                                    const longitude = position.coords.longitude;
                                    getMap(latitude, longitude);
                                }
                                function error() {
                                    alert("Unable to retrieve location");
                                }
                                function getMap(latitude, longitude) {
                                    map = L.map("map").setView([latitude, longitude], 20);
                                    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);
                                    L.marker([latitude, longitude]).addTo(map);

                                    map.on('click', onMapClick);
                                }

                                var lastMarker = null; // Initialize variable to hold the last marker

                                // Function to handle map click events
                                function onMapClick(e) {
                                    // Remove the last marker if it exists
                                    if (lastMarker) {
                                        map.removeLayer(lastMarker);
                                    }

                                    // Get the clicked coordinates
                                    var lat = e.latlng.lat;
                                    var lng = e.latlng.lng;

                                    // Create a marker at the clicked coordinates
                                    var marker = L.marker([lat, lng]).addTo(map);

                                    // Add a popup to the marker
                                    marker.bindPopup("Your shop location is in: " + lat + ", " + lng).openPopup();

                                    // Update the lastMarker variable
                                    lastMarker = marker;

                                    document.getElementById("longitude").value=lng;
                                    document.getElementById("latitude").value=lat;
                                }

                                // var lastMarker = null; // Initialize variable to hold the last marker

                                // // Function to handle map click events
                                // function onMapClick(e) {
                                //     // Remove the last marker if it exists
                                //     if (lastMarker) {
                                //         map.removeLayer(lastMarker);
                                //     }

                                //     // Get the clicked coordinates
                                //     var lat = e.latlng.lat;
                                //     var lng = e.latlng.lng;

                                //     // Create a marker at the clicked coordinates
                                //     var marker = L.marker([lat, lng]).addTo(map);

                                //     // Add a popup to the marker
                                //     marker.bindPopup("Your shop location is in: " + lat + ", " + lng).openPopup();

                                //     // Update the lastMarker variable
                                //     lastMarker = marker;

                                //     document.getElementById("longitude").value=lng;
                                //     document.getElementById("latitude").value=lat;

                                //     console.log(e);
                                // }

                                // // Add a click event listener to the map
                                // map.on('click', onMapClick);
                            </script>
                        </div>
                    </td>
                    <td>
                        <div id="registerShopContainer">
                            <form method="post" action="../service/registerShop.php">
                                <div>
                                    <label for="shopName">🏢 Shop Name: </label>
                                    <input type="text" id="shopName" name="shopName" required placeholder="Your shop name goes here">
                                </div>
                                <div>
                                    <label for="realName">🧑‍💼 Real Full Name: </label>
                                    <input type="text" id="realName" name="realName" required placeholder="Your real full name goes here">
                                </div>
                                <div>
                                    <label for="phoneNumber">📞 Phone Number: </label>
                                    <input type="text" id="phoneNumber" name="phoneNumber" required placeholder="Your phone number goes here">
                                </div>
                                <div>
                                    <label for="longitude">📌 Longitude: </label>
                                    <input type="text" id="longitude" name="longitude" required placeholder="Click on map to set" readonly>
                                </div>
                                <div>
                                    <label for="latitude">📌 Latitude: </label>
                                    <input type="text" id="latitude" name="latitude" required placeholder="Click on map to set" readonly>
                                </div>
                                <input type="submit" id="submit" name="addShop" value="Submit">
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
        </main>
    </div>
</body>
</html>
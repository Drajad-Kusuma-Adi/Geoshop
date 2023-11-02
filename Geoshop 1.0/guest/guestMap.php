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
            <div class="float-start" style="margin-left: 2%;">
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
        <div id="map" class="container-fluid" style="height: 450px;">
            <script>
                console.log(this);
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
                    const map = L.map("map").setView([latitude, longitude], 20);
                    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);
                    L.marker([latitude, longitude]).addTo(map);
                }
            </script>
        </div>
    </main>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
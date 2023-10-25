<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Geolocation API</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  </head>
  <body>
    <div id="map" style="height: 500px">
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
                console.log(accuracy);
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                getMap(latitude, longitude);
            }
            function error() {
                alert("Unable to retrieve location");
            }
            function getMap(latitude, longitude) {
                console.log(latitude);
                console.log(longitude);
                const map = L.map("map").setView([latitude, longitude], 20);
                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);
                L.marker([latitude, longitude]).addTo(map);
            }
        </script>
    </div>
    <div>
        <a href="userProfile.php">Profile</a>
    </div>
  </body>
</html>
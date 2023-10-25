<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <style>
        #map{
            width: 100%;
            height: 100vh;
        }

    </style>
</head>
<body>
    <div id="map"></div>
    <script>
        // Check if geolocation is available in the browser
        if ("geolocation" in navigator) {
            // Get the current position
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                
                
                // You can use the latitude and longitude values in your application
            }, function(error) {
                // Handle any errors that occur during geolocation
                console.error("Error getting geolocation:", error.message);
            });
        } else {
            console.log("Geolocation is not available in this browser.");
        }


        let mapOptions = {
            center:[-8.0089, 112.5797],
            zoom:10
        }

        let map = new L.map('map' , mapOptions);

        let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(layer);

        let customIcon = {
            iconUrl:"../image/mapMarker.jpg",
            iconSize:[20,40]
        }

        let myIcon = L.icon(customIcon);
        //let myIcon = L.divIcon();

        let iconOptions = {
            title:"company name",
            draggable:true,
            icon:myIcon
        }

        const apiUrl = 'http://localhost/Geoshop/service/shopLocation.php';
        const getToko = fetch(apiUrl).then(response => {
            if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            return data;
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });

        const showData = async () => {
            const data = await getToko;
            data.forEach(property => {
                let marker = new L.Marker([property.latitude, property.longitude] , iconOptions);
                marker.addTo(map);
                marker.bindPopup(property.name).openPopup();
            });
        };

        showData();


    </script>
</body>
</html>
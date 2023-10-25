var map = L.map('osm-map');
var target = L.latLng(47.50737, 19.04611);
map.setView(target, 14);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

function successCallback(position) {
    var userLocation = L.latLng(position.coords.latitude, position.coords.longitude);
    map.setView(userLocation, 14);
}

function errorCallback(error) {
    console.log(error);
}

navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

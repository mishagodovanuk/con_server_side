// Drag and popup
// --------------------------------------------------------------------

var coordinates = []

let marker = null;

if ($("#map").length) {

    let loadCoordinates = [coordinatesLoad.lat, coordinatesLoad.lng]; //Replace with your own coordinates
    // console.log(loadCoordinates)

    // Creating map options
    var mapOptions = {
        center: loadCoordinates,
        zoom: 18,
        dragging: true,
    };

    // Creating a map object
    var map = new L.map("map", mapOptions);

    // Creating a Layer object
    var layer = new L.tileLayer(
        "https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}",
        {
            maxZoom: 18,
            subdomains: ["mt0", "mt1", "mt2", "mt3"],
        }
    );

    // Adding layer to the map
    map.addLayer(layer);

    // Icon options
    var iconOptions = {
        iconUrl: "/assets/icons/marker.png",
        iconSize: [25, 35],
    };
    // Creating a custom icon
    var customIcon = L.icon(iconOptions);

    // Creating Marker Options
    var markerOptions = {
        title: "Warehouse Location",
        clickable: true,
        draggable: false,
        icon: customIcon,
    };

    // Your coordinates

    // Creating a Marker
    marker = new L.Marker(loadCoordinates, markerOptions).addTo(map);

    let latlng = L.latLng(loadCoordinates[0], loadCoordinates[1]);

    map.flyTo(latlng, 18);
}









var map = null; 
export async function initializeMap() {
    if (map) {
        map.remove();
    }
     map = L.map("basic-map", { locale: "en" });
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
    }).addTo(map);
    try {
        const { waypoints, titles } = await getCoordinatesForCustomData(
            dataActions
        );
        createRouteMap({ waypoints, titles });
    } catch (error) {
        console.error("Помилка отримання координат:", error);
    }
    function createRouteMap({ waypoints, titles }) {
        var routeControl = L.Routing.control({
            waypoints,
            routeWhileDragging: true,
            language: "en",
        }).addTo(map);
        waypoints.forEach((waypoint, i) => {
            L.marker(waypoint).addTo(map).bindPopup(titles[i]);
        });
    }
    function getCoordinatesForCustomData(dataActions) {
        // замінити ключ на sk пошту
        var apiKey = "AIzaSyAMVD23D0c1TMSMX7m66SjY365nXzTb3lU";
        var geocodingUrl = "https://maps.googleapis.com/maps/api/geocode/json";
        function getCoordinates(address) {
            var requestUrl = `${geocodingUrl}?address=${encodeURIComponent(
                address
            )}&key=${apiKey}`;
            return new Promise((resolve, reject) => {
                fetch(requestUrl)
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.status === "OK") {
                            var location = data.results[0].geometry.location;
                            var latitude = location.lat;
                            var longitude = location.lng;
                            resolve(L.latLng(latitude, longitude));
                        } else {
                            reject(`Помилка: ${data.status}`);
                        }
                    })
                    .catch((error) => reject(`Помилка запиту: ${error}`));
            });
        }
        var promises = dataActions.map((action) =>
            getCoordinates(action.address)
        );
        return Promise.all(promises).then((coordinatesArray) => {
            var waypoints = coordinatesArray.map((coord) =>
                L.latLng(coord.lat, coord.lng)
            );
            var titles = dataActions.map(({ name }) => name);
            return { waypoints, titles };
        });
    }
}







// Версія з нумерацією


// import { customDataActions } from "./db/data-action.js";

// var map = null; 
// export async function initializeMap() {
//     if (map) {
//         map.remove();
//     }
//      map = L.map("basic-map", { locale: "en" });

//     L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
//         maxZoom: 19,
//     }).addTo(map);

//     try {
//         const { waypoints, titles,numbers } = await getCoordinatesForCustomData(
//             customDataActions
//         );
//         createRouteMap({ waypoints, titles ,numbers});
//     } catch (error) {
//         console.error("Помилка отримання координат:", error);
//     }

//     function createRouteMap({ waypoints, titles, numbers }) {
//         var routeControl = L.Routing.control({
//             waypoints,
//             routeWhileDragging: false,
//             language: "en",
//             addWaypoints: false,
//         }).addTo(map);

    
//         waypoints.forEach((waypoint, i) => {
//             var labelText = String(numbers[i] ? numbers[i] : '')
    
//             var circleMarker = L.circleMarker(waypoint, {
//                 radius: 2,
//                 color: 'white',
//                 fillOpacity: 0.8,
//             }).addTo(map);
    
//             var textOptions = {
//                 className: 'marker-map-route',
//                 direction: 'center',
//                 permanent: true,
//             };
    
//             L.marker(waypoint)
//                 .addTo(map)
//                 .bindPopup(titles[i])
//                 .bindTooltip(labelText, textOptions);
    
//         });
//     }
    
    
    
    
    
// function getCoordinatesForCustomData(customDataActions) {
//     var apiKey = "AIzaSyAMVD23D0c1TMSMX7m66SjY365nXzTb3lU";
//     var geocodingUrl = "https://maps.googleapis.com/maps/api/geocode/json";

//     function getCoordinates(address) {
//         var requestUrl = `${geocodingUrl}?address=${encodeURIComponent(
//             address
//         )}&key=${apiKey}`;

//         return new Promise((resolve, reject) => {
//             fetch(requestUrl)
//                 .then((response) => response.json())
//                 .then((data) => {
//                     if (data.status === "OK") {
//                         var location = data.results[0].geometry.location;
//                         var latitude = location.lat;
//                         var longitude = location.lng;
//                         resolve({ lat: latitude, lng: longitude }); // Return as an object
//                     } else {
//                         reject(`Помилка: ${data.status}`);
//                     }
//                 })
//                 .catch((error) => reject(`Помилка запиту: ${error}`));
//         });
//     }

//     var promises = customDataActions.map((action) =>
//         getCoordinates(action.address)
//     );

//     return Promise.all(promises).then((waypoints) => {
//         var titles = customDataActions.map(({ name }) => name);
//         var numbers = customDataActions.map(({ number }) => number);
//         return { waypoints, titles, numbers };
//     });
// }

// }



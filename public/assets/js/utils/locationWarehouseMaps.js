// Drag and popup
// --------------------------------------------------------------------

var startLocation = [49.820434685575165, 24.003130383455048]


if ($("#map").length) {
    // Creating map options
    var mapOptions = {
        center: startLocation,
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

    // Marker Options
    var markerOptions = {
        title: "Warehouse Location",
        clickable: true,
        draggable: true, // Allow dragging the marker
        icon: customIcon,
    };

    var marker = null;

    // Function to add a marker and populate input
    function addMarkerAndPopulateInput(latlng) {
        if (marker) {
            marker.remove();
        }

        marker = new L.Marker(latlng, markerOptions).addTo(map);
        $('#map-input').val(latlng.lat + ', ' + latlng.lng);
    }

    // Check if coordinates exist
    if (coordinates) {
        var latlng = L.latLng(coordinates.lat, coordinates.lng);
        addMarkerAndPopulateInput(latlng);

        // Centering map on the marker
        map.setView(latlng, 18);

    } else {
        var coordinates = null; // Initialize coordinates
    }

    // Click event listener for map
    map.on('click', function (ev) {
        if (marker) {
            marker.remove();
        }
        coordinates = ev.latlng;
        addMarkerAndPopulateInput(coordinates);

        $("#messageAdd")
            .html("Локацію було успішно додано")
            .css("display", "inline-flex")
            .delay(5000)
            .slideUp(300);

        var nextStep = $("#next_step")[0];
        if (nextStep) {
            nextStep.removeAttribute('disabled');
        }
    });
}


$("#map-input").on("blur keyup", async function (e) {
    if (e.type === "keyup" && e.key !== "Enter") {
        return;
    }
    let addLocationInput = document.getElementById("map-input").value;
    let coordinate = addLocationInput.split(", ");
    let string = addLocationInput.split(" ");
    console.log(string)
    let boolCoordinate = parseInt(coordinate[0]);
    if (!Number.isInteger(boolCoordinate)) {
        coordinate = coordinate.join("");
    }

    if (marker) {
        marker.remove();
    }

    if (coordinate.length === 2) {
        // Creating a Marker
        marker = new L.Marker(
            [coordinate[0], coordinate[1]],
            markerOptions
        ).addTo(map);
        let latlng = L.latLng(coordinate[0], coordinate[1]);
        coordinates = latlng
        map.flyTo(latlng, 18);
        //console.log("1 if")

    } else if (string.length === 3) {
        //console.log("2 if")
        var settlement = string[0]
        var street = string[1]
        var buildingNumber = string[string.length - 1]

        // Видаляємо "м." з тексту міста (якщо присутнє)
        settlement = settlement.replace(/^(м\.|с\.)/, '').trim();

        // Видаляємо "вул." з тексту вулиці (якщо присутня)
        street = street.replace(/^вул\./, '').trim();

        console.log(`Місто: ${settlement}`);
        console.log(`Вулиця: ${street}`);
        console.log(`buildingNumber: ${buildingNumber}`);

        // отримуємо контейнер для адрес
        let addresses = `street=${street}/${buildingNumber}&city=${settlement}&country=Україна`

        // отримуємо в-дь від сервісу
        var response = await fetch(
            `https://nominatim.openstreetmap.org/search?${addresses}&format=json&limit=1`)

        try {
            var {lat, lon} = (await response.json())[0];
        } catch (error) {
            if (!lat) {
                $("#messageAddError")
                    .html("Локацію не знайдено.Замініть дані в полі пошуку!")
                    .css("display", "inline-flex")
                    .delay(5000)
                    .slideUp(300);
            }
        }
        var position = [lat, lon];

        // формуємо повідомлення
        // coordinates = addLocationInput
        coordinates = {lat: +lat, lng: +lon}
        //var tooltip = `${name}<br>${addresses}`;
        //console.log(tooltip);
        if (marker !== null) {
            map.removeLayer(marker);
        }
        //Creating a Marker
        marker = new L.Marker(position, markerOptions).addTo(map);
        let latlng = L.latLng(lat, lon);
        //console.log(latlng);
        map.flyTo(latlng, 18);
    }

    $("#messageAdd")
        .html("Локацію було успішно додано")
        .css("display", "inline-flex")
        .delay(5000)
        .slideUp(300);
    var nextStep = $("#next_step")[0];
    if (nextStep) {
        nextStep.removeAttribute('disabled')
    }
    //console.log(marker);
});

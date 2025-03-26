</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
   // Function to initialize the map
function initMap(lat, lon) {
    // Show the loading spinner
    document.getElementById('loading-spinner').style.display = 'block';

    // Create a promise to handle the minimum display time for the spinner
    const spinnerTimeout = new Promise((resolve) => {
        setTimeout(resolve, 2000); // 2 seconds
    });

    // Create the map and set its view to the user's location
    var map = L.map('map').setView([lat, lon], 13);

    // Add OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Add a red marker for the user's location
    var userIcon = L.icon({
        iconUrl: 'https://img.freepik.com/free-vector/3d-gradient-map-pin_78370-1524.jpg?t=st=1742939466~exp=1742943066~hmac=2004924faa03a9e5b7be56b211705ca5d9816bdeb8d156d58f8737abcf3b453d&w=900', // URL for a red pin icon
        iconSize: [25, 41], // Size of the icon
        iconAnchor: [12, 41], // Point of the icon which will correspond to marker's location
    });

    // Create a marker for the user's location
    var userMarker = L.marker([lat, lon], { icon: userIcon }).addTo(map);
    userMarker.bindPopup("You are here!").openPopup();

    // Fetch nearby toy stores
    fetchNearbyStores(lat, lon, map);

    // Hide the loading spinner once the map is fully loaded
    map.on('load', function() {
        // Wait for the spinner timeout to complete before hiding the spinner
        spinnerTimeout.then(() => {
            document.getElementById('loading-spinner').style.display = 'none';
        });
    });

    // Hide the spinner if the map fails to load
    map.on('error', function() {
        document.getElementById('loading-spinner').style.display = 'none';
    });
}

// Function to handle geolocation success
function showPosition(position) {
    var lat = position.coords.latitude;
    var lon = position.coords.longitude;
    initMap(lat, lon); // Initialize the map with user's location
}

// Function to handle geolocation errors
function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("User  denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
}

// Function to fetch nearby toy stores
function fetchNearbyStores(lat, lon, map) {
    // Define the Overpass API query to find toy stores within 5 miles (8046.72 meters)
    var query = `
        [out:json];
        (
          node["shop"="toys"](around:16093.44, ${lat}, ${lon});
          way["shop"="toys"](around:16093.44, ${lat}, ${lon});
          relation["shop"="toys"](around:16093.44, ${lat}, ${lon});
        );
        out body;
    `;

    var overpassUrl = 'https://overpass-api.de/api/interpreter?data=' + encodeURIComponent(query);

    fetch(overpassUrl)
        .then(response => response.json())
        .then(data => {
            displayStores(data.elements, map);
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Function to display toy stores on the map
function displayStores(stores, map) {
    // Add markers for each store
    stores.forEach(store => {
        if (store.type === 'node') {
            var marker = L.marker([store.lat, store.lon]).addTo(map);
            marker.bindPopup(store.tags.name || 'Store').openPopup();
        }
    });
}

// Get the user's location
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
} else {
    alert("Geolocation is not supported by this browser.");
}
    </script>
</body>
</html>
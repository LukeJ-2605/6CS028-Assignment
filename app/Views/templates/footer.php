<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Your JavaScript code goes here
        // Check if geolocation is supported
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }

        function showPosition(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;

            // Call the function to fetch nearby stores
            fetchNearbyStores(lat, lon);

            // Add a red marker for the user's location
            var userIcon = L.icon({
                iconUrl: 'https://upload.wikimedia.org/wikipedia/commons/5/5c/Red_pin.svg', // URL for a red pin icon
                iconSize: [25, 41], // Size of the icon
                iconAnchor: [12, 41], // Point of the icon which will correspond to marker's location
            });

            // Create a marker for the user's location
            var userMarker = L.marker([lat, lon], { icon: userIcon }).addTo(map);
            userMarker.bindPopup("You are here!").openPopup();
        }

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

        function fetchNearbyStores(lat, lon) {
            // Define the Overpass API query to find toy stores
            var query = `
                [out:json];
                (
                  node["shop"="toys"](around:8046.72, ${lat}, ${lon});
                  way["shop"="toys"](around:8046.72, ${lat}, ${lon});
                  relation["shop"="toys"](around:8046.72, ${lat}, ${lon});
                );
                out body;
            `;

            var overpassUrl = 'https://overpass-api.de/api/interpreter?data=' + encodeURIComponent(query);

            fetch(overpassUrl)
                .then(response => response.json())
                .then(data => {
                    displayStores(data.elements, lat, lon);
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function displayStores(stores, lat, lon) {
            // Initialize the map with the user's location
            var map = L.map('map').setView([lat, lon], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Add markers for each store
            stores.forEach(store => {
                if (store.type === 'node') {
                    var marker = L.marker([store.lat, store.lon]).addTo(map);
                    marker.bindPopup(store.tags.name || 'Store').openPopup();
                }
            });
        }
    </script>
</body>
</html>
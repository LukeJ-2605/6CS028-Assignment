// Check for browser support
    if (!('webkitSpeechRecognition' in window)) {
        alert("Your browser does not support speech recognition. Please use Google Chrome.");
    } else {
        const recognition = new webkitSpeechRecognition();
        recognition.continuous = false; // Stop after one result
        recognition.interimResults = false; // No interim results

        // Event handler for when speech recognition results are returned
        recognition.onresult = function(event) {
            const transcript = event.results[0][0].transcript; // Get the recognized text
            document.getElementById('search-bar').value = transcript; // Populate the search bar
            document.getElementById('search-form').submit(); // Optionally submit the form
        };

        // Event handler for errors
        recognition.onerror = function(event) {
            console.error("Speech recognition error: ", event.error);
        };

        // Start speech recognition when the button is clicked
        document.getElementById('start-speech').addEventListener('click', function() {
            recognition.start(); // Start listening
        });
    }
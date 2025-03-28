// Function to check if the user is on a mobile device
function isMobileDevice() {
    return /Mobi|Android/i.test(navigator.userAgent);
}

// Function to apply the appropriate theme based on user preference
function applyTheme(isDark) {
    const body = document.body;
    if (isDark) {
        body.classList.add("dark-mode");
        body.classList.remove("light-mode");
    } else {
        body.classList.add("light-mode");
        body.classList.remove("dark-mode");
    }
}

// Check if the user is on a mobile device
if (isMobileDevice()) {
    const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");

    // Initial theme application based on user's preference
    applyTheme(prefersDarkScheme.matches);

    // Listen for changes in the user's preference
    prefersDarkScheme.addEventListener("change", (event) => {
        applyTheme(event.matches);
    });
}
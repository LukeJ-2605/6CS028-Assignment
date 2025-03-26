<!doctype html>
<html>
<head>
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <title>Buy Cards</title>
    <style>
		body {
			background-color: #D2B48C; /* A nice blue color */
		}
		.sticky-top {
			background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent background */
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
		}
        .map {
            height: 600px; /* The height of the map */
        }
		 .card-body {
        text-align: center;
		background-color: #F5F5DC;		/* Center text and images */
		}
		.card img {
        max-width: 100%; /* Ensure the image is responsive */
        height: auto; /* Maintain aspect ratio */
		}
		
		.search-container {
		position: relative; /* Position relative to contain the absolute positioning of suggestions */
		}

		.suggestions-list {
			max-height: 200px; /* Limit the height of the suggestions */
			overflow-y: auto; /* Enable scrolling if there are many suggestions */
			border: 1px solid #ccc; /* Border for the suggestions box */
			background: white; /* Background color */
			position: absolute; /* Position it absolutely */
			z-index: 1000; /* Ensure it appears above other elements */
			width: 100%; /* Match the width of the search bar */
			margin-top: 0; /* No margin to align directly below the search bar */
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Optional: Add a shadow for better visibility */
		}	

		.suggestion-item {
			padding: 8px; /* Padding for each suggestion */
			cursor: pointer; /* Pointer cursor on hover */
		}

		.suggestion-item:hover {
			background-color: #f0f0f0; /* Highlight on hover */
		}
		.card-custom {
			background-color: #F5F5DC; /* Dark brown color */
			color: black; /* Change text color to white for better contrast */
		}
		.navbar-custom {
			background-color: #F5F5DC; /* Tan color */
			color: black; /* Dark text for better readability */
		}
    </style>
</head>
<body>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
  <div class="container-fluid d-flex">
    <!-- Toggler Button on the Left -->
    <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Brand -->
    <h1><?= esc($title) ?></h1>

    <!-- Navbar Items in the Center -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= base_url('pokemon') ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('store_locations') ?>">Buy Cards</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('pokemon/new') ?>">Add Card</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Account
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">View Profile</a></li>
            <li><a class="dropdown-item" href="#">Login</a></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <!-- Search Box on the Right -->
    <div class="search-container" style="position: relative;">
    <form class="d-flex ms-auto" role="search" action="<?= base_url('pokemon/search') ?>" method="get" id="search-form">
        <input class="form-control me-2" type="search" name="query" id="search-bar" placeholder="Search" aria-label="Search" oninput="fetchSuggestions(this.value)">
        <button class="btn btn-outline-success" type="submit">Search</button>
        <button type="button" class="btn btn-outline-info" id="start-speech">🎤</button> <!-- Speech button -->
    </form>
    <div id="suggestions" class="suggestions-list" style="display: none;"></div>
</div>

  </div>
</nav>






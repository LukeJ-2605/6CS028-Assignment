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
        #map {
            height: 600px; /* Set the height of the map */
        }
    </style>
</head>
<body>

<h1><?= esc($title) ?></h1>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid d-flex">
    <!-- Toggler Button on the Left -->
    <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Brand -->
    

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
    <form class="d-flex ms-auto" role="search" action="<?= base_url('pokemon/search') ?>" method="get">
  <input class="form-control me-2" type="search" name="query" id="search-bar" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success" type="submit">Search</button>
</form>

  </div>
</nav>




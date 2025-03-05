<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Cards</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
     <div class="container mt-4">
        <h1 class="text-center">Pokémon Cards</h1>
        <div class="row">
            <?php if (!empty($cards)): ?>
                <?php foreach ($cards as $card): ?>
                    <div class="col-md-3 mb-4"> <!-- 4 cards per row -->
                        <div class="card">
                            <img src="<?php echo esc($card['images']['small'] ?? ''); ?>" class="card-img-top" alt="<?php echo esc($card['name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo esc($card['name']); ?></h5>
                                <p class="card-text">Type: <?php echo esc(implode(', ', $card['types'] ?? [])); ?></p>
                                <p class="card-text">Set: <?php echo esc($card['set']['name'] ?? 'N/A'); ?></p>
                                <a href="" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No Pokémon cards found.</p>
            <?php endif; ?>
        </div>
    </div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
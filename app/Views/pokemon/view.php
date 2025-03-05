<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
</head>
<body>
    <div class="container mt-4">
        <h1><?= esc($card['card_name']) ?></h1>
        <img src="<?= esc($card['image_url']) ?>" alt="<?= esc($card['card_name']) ?>" class="img-fluid">
        <p><strong>Type:</strong> <?= esc($card['card_type']) ?></p>
        <p><strong>Set:</strong> <?= esc($card['card_set']) ?></p>
        <p><strong>Card ID:</strong> <?= esc($card['card_id']) ?></p>
        <a href="<?= base_url('pokemon') ?>" class="btn btn-secondary">Back to List</a>
    </div>
</body>
</html>
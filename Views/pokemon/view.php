<div class="container text-center">
<h2><?= esc($pokemon['card_name']) ?></h2>
<p> <img src="<?php echo esc($pokemon['image_url']) ?>"></p>
<p>Type: <?= esc($pokemon['card_type']) ?></p>
<p>Set: <?= esc($pokemon['card_set']) ?></p>
</div>
<?php if ($pokemon_list !== []): ?>

	<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-5">
	
    <?php foreach ($pokemon_list as $pokemon_item): ?>
		<div class="col">
			<div class="card" style="width: 18rem;">
				<div class="card-body">
					<h3 class="card-title"><?= esc($pokemon_item['card_name']) ?></h3>
					<p class="card-text"><img src="<?php echo esc($pokemon_item['image_url']) ?>"></p>
					<p class="card-text"><?= esc($pokemon_item['card_type']) ?></p>
					<p> <a href="<?=base_url()?>/pokemon/<?= esc($pokemon_item['slug'], 'url') ?>">View article</a></p>
				</div>
			</div>
		</div>
		
    <?php endforeach ?>
	</div>
<?php else: ?>

    <h3>No Pokemon</h3>

    <p>Unable to find any pokemon for you.</p>

<?php endif ?>
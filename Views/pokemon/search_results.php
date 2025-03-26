<h2>Search Results</h2>

<?php if (empty($pokemon_list)): ?>
    <p>No matching results found.</p>
<?php else: ?>
    <ul>
        <?php foreach ($pokemon_list as $pokemon): ?>
            <li>
                <a href="<?= site_url('pokemon/view/' . $pokemon['slug']) ?>"><?= esc($pokemon['card_name']) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

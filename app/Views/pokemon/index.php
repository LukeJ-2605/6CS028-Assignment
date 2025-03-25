<p id="ajaxArticle"></p>

<?php if ($pokemon_list !== []): ?>

	<div class="row row-cols-1 row-cols-xs-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-xxl-6 g-0 justify-content-center">
	
    <?php foreach ($pokemon_list as $pokemon_item): ?>
		<div class="col">
			<div class="card w-100 mt-2">
				<div class="card-body">
					<h3 class="card-title"><?= esc($pokemon_item['card_name']) ?></h3>
					<p class="card-text"><img src="<?php echo esc($pokemon_item['image_url']) ?>"></p>
					<p class="card-text"><?= esc($pokemon_item['card_type']) ?></p>
					<p> <a href="<?=base_url()?>/pokemon/<?= esc($pokemon_item['slug'], 'url') ?>">View Card</a></p>
					<p><button onclick="getData('<?= esc($pokemon_item['slug'], 'url') ?>')">View Card Details via Ajax</button></p>
				</div>
			</div>
		</div>
		
    <?php endforeach ?>
	</div>
<?php else: ?>

    <h3>No Pokemon</h3>

    <p>Unable to find any pokemon for you.</p>

<?php endif ?>
<script>
	function getData(slug) {
		
		// Fetch data
		fetch('https://mi-linux.wlv.ac.uk/~2222880/main-assignment/public/ajax/get/' + slug)
			
		  // Convert response string to json object
		  .then(response => response.json())
		  .then(response => {

			// Copy one element of response to our HTML paragraph
			document.getElementById("ajaxArticle").innerHTML = response.card_name + ": " + response.card_type;
		  })
		  .catch(err => {
			
			// Display errors in console
			console.log(err);
		});
	}
	
	function fetchSuggestions(query) {
    if (query.length < 2) {
        document.getElementById('suggestions').style.display = 'none';
        return; // Don't fetch suggestions if the query is too short
    }

    fetch('<?= base_url('ajax/suggest') ?>/' + query)
        .then(response => response.json())
        .then(data => {
            const suggestionsContainer = document.getElementById('suggestions');
            suggestionsContainer.innerHTML = ''; // Clear previous suggestions

            if (data.length > 0) {
                data.forEach(item => {
                    const suggestionItem = document.createElement('div');
                    suggestionItem.textContent = item.card_name; // Adjust based on your data structure
                    suggestionItem.classList.add('suggestion-item');
                    suggestionItem.onclick = function() {
                        document.getElementById('search-bar').value = item.card_name; // Set the input value
                        document.getElementById('search-form').submit(); // Submit the form
                    };
                    suggestionsContainer.appendChild(suggestionItem);
                });
                suggestionsContainer.style.display = 'block'; // Show suggestions
            } else {
                suggestionsContainer.style.display = 'none'; // Hide if no suggestions
            }
        })
        .catch(err => console.error('Error fetching suggestions:', err));
}
	
	
</script>
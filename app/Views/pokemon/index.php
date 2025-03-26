<p id="ajaxArticle"></p>

<?php if ($pokemon_list !== []): ?>

	<div class="row row-cols-1 row-cols-xs-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5  g-0 justify-content-center">
	
    <?php foreach ($pokemon_list as $pokemon_item): ?>
		<div class="col">
			<div class="card w-100 mt-2 card-custom">
				<div class="card-body">
					<h4 class="card-title"><?= esc($pokemon_item['card_name']) ?></h4>
					<p class="card-text"><img data-src="<?php echo esc($pokemon_item['image_url']) ?>" class="lazy-load"></p>
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
document.addEventListener("DOMContentLoaded", function() {
        const lazyLoadImages = document.querySelectorAll('.lazy-load');

        const options = {
            root: null, // Use the viewport as the root
            rootMargin: '0px',
            threshold: 0.1 // Trigger when 10% of the element is visible
        };

        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src; // Set the src from data-src
                    img.classList.remove('lazy-load'); // Remove lazy-load class
                    observer.unobserve(img); // Stop observing this image
                }
            });
        }, options);

        lazyLoadImages.forEach(image => {
            imageObserver.observe(image); // Start observing each image
        });
    });
	
	
</script>
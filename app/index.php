<p id="ajaxArticle"></p>

<h2><?= esc($title) ?></h2>

<?php if ($news_list !== []): ?>

    <?php foreach ($news_list as $news_item): ?>

        <h3><?= esc($news_item['title']) ?></h3>

        <div class="main">
            <?= esc($news_item['body']) ?>
        </div>
        <p><a href="<?=base_url()?>/news/<?= esc($news_item['slug'], 'url') ?>">View article</a></p>
        <p><button onclick="getData('<?= esc($news_item['slug'], 'url') ?>')">View article via Ajax</button></p>
        

    <?php endforeach ?>

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>
<script>
	function getData(slug) {
		
		// Fetch data
		fetch('https://mi-linux.wlv.ac.uk/~2222880/first-project/public/ajax/get/' + slug)
			
		  // Convert response string to json object
		  .then(response => response.json())
		  .then(response => {

			// Copy one element of response to our HTML paragraph
			document.getElementById("ajaxArticle").innerHTML = response.title + ": " + response.body;
		  })
		  .catch(err => {
			
			// Display errors in console
			console.log(err);
		});
	}
</script>
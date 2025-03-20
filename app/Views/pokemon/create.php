<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="<?=base_url()?>/pokemon" method="post">
    <?= csrf_field() ?>

    <label for="Name">Card Name</label>
    <input type="input" name="card_name" value="<?= set_value('card_name') ?>">
    <br>

    <label for="Type">Card Type</label>
    <textarea name="card_type" cols="45" rows="4"><?= set_value('card_type') ?></textarea>
    <br>
	
	<label for="Image">Card Image</label>
    <textarea name="card_image" cols="45" rows="4"><?= set_value('image_url') ?></textarea>
    <br>
	
	<label for="Set">Card Set</label>
    <textarea name="card_set" cols="45" rows="4"><?= set_value('card_set') ?></textarea>
    <br>

    <input type="submit" name="submit" value="Add Card">
</form>
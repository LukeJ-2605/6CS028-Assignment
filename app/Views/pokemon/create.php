<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/pokemon" method="post">
    <?= csrf_field() ?>

    <label for="name">Card Name</label>
    <input type="input" name="name" value="<?= set_value('card_name') ?>">
    <br>

    <label for="type">Card Type</label>
    <textarea name="type" cols="45" rows="4"><?= set_value('card_type') ?></textarea>
    <br>

    <input type="submit" name="submit" value="Add Card">
</form>
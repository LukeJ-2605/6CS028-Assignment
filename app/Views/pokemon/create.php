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

    <input type="submit" name="submit" value="Add Card">
</form>
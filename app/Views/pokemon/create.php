<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="<?= base_url('pokemon') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="card_name">Card Name</label>
        <input type="text" name="card_name" id="card_name" value="<?= set_value('card_name') ?>" required placeholder="Enter card name" class="form-control">
    </div>

    <div class="form-group">
        <label for="card_type">Card Type</label>
        <textarea name="card_type" id="card_type" cols="45" rows="4" required placeholder="Enter card type" class="form-control"><?= set_value('card_type') ?></textarea>
    </div>

    <div class="form-group">
        <label for="image_url">Card Image</label>
        <input type="text" name="image_url" id="image_url" value="<?= set_value('image_url') ?>" required placeholder="Enter image link" class="form-control">
    </div>

    <div class="form-group">
        <label for="card_set">Card Set</label>
        <textarea name="card_set" id="card_set" cols="45" rows="4" required placeholder="Enter card set" class="form-control"><?= set_value('card_set') ?></textarea>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Add Card</button>
</form>
<form action="" method="post">
    <?php foreach($fields AS $field): ?>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="<?= $field['Field'] ?>" id="<?= $field['Field'] ?>" placehorlder="Adress mail" value="<?= ($op =='update') ? $values[$field['Field']] : ''; ?>">
            <label for="<?= $field['Field'] ?>" class="form-label"> <?= ucfirst($field['Field']) ?></label>
        </div>
    <?php endforeach; ?>

    <div class="text-center mt-5">
        <button type="submit" class="btn btn-primary">Valider</button>
    </div>
</form>
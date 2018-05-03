<option value="" class="label"><?= $this->currency['code']; ?></option>

<?php foreach ($this->currencies as $key => $value): ?>
    <option value="<?= $key ?>"><?= $key ?></option>
<?php endforeach; ?>
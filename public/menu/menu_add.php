<option value="<?=$id;?>"><?=$tab . $category['title'];?></option>
<?php if (isset($category['child'])): ?>
    <?= $this->getMenuHtml($category['child'], '&nbsp;'.$tab. '-'); ?>
<?php endif; ?>

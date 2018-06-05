<?php //$parent = isset($category['child']); ?>
<li>
    <a href="/category/<?= $category['alias']; ?>"><?= $category['title']; ?></a>
    <?php if (isset($category['child'])): ?>
        <ul>
            <?= $this->getMenuHtml($category['child']); ?>
        </ul>
    <?php endif; ?>
</li>
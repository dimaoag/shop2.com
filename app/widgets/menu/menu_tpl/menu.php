<li>
    <a href="?id=<?= $id; ?>"><?= $category['title']; ?></a>
    <?php if (isset($category['child'])): ?>
        <ul>
            <?= $this->getMenuHtml($category['child']); ?>
        </ul>
    <?php endif; ?>
</li>
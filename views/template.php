<?php foreach ($artists as $artist): ?>
<div>
    <?= $artist ?>
    <a href="<?= $artist->getProperty('url') ?>" target="_blank">
        <img src="<?= $artist->getImage() ?>" alt="<?= $artist ?>">
    </a>
</div>
<?php endforeach; ?>

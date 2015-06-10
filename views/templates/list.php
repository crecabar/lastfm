<div id="artistList">
    <ul>
    <?php foreach ($artists as $artist): ?>
        <li>
            <div id="artistName"><?= $artist ?></div>
            <div id="artistImage">
                <?= \Includes\Helpers::printLink(
                        $artist->url,
                        \Includes\Helpers::printImg($artist->getImage()),
                        array('target' => '_blank'))?>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
</div>
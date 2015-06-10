<?php
require_once __DIR__ . '/../config/Config.php';
use Config\Config;
use Lib\Lastfm;

$config = Config::getInstance();

$content = "";
$content .= \Includes\Helpers::render('templates/header');
$content .= \Includes\Helpers::render('templates/search-form');

if (!empty($keyword = filter_input(INPUT_GET, 'keyword'))) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ? : 0; //TODO: add pager management.
    $lastFm = new Lastfm\LastfmSearch(['page_number' => $page]);
    $content .= \Includes\Helpers::render('templates/list', ['artists' => $lastFm->run($keyword)]);
}

$content .= \Includes\Helpers::render('templates/footer');

echo \Includes\Helpers::render('template', ['content' => $content]);
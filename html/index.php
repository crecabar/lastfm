<?php

require_once __DIR__ . '/../config/Config.php';
use Config\Config;
use Lib\Lastfm;

$config = Config::getInstance();


if(!empty($keyword = filter_input(INPUT_GET, 'keyword'))){
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ? : 0;
    $lastFm = new Lastfm\LastfmSearch(['page_number' => $page]);
    \Includes\Helpers::render('templates/header');
    \Includes\Helpers::render('templates/search-form');
    \Includes\Helpers::render('template', ['artists' => $lastFm->run($keyword)]);
} else {
    \Includes\Helpers::render('templates/search-form');
}
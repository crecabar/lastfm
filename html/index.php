<?php

require_once __DIR__ . '/../config/Config.php';
use Config\Config;
use Lib\Lastfm;

if(!empty($keyword = filter_input(INPUT_GET, 'keyword'))){
    $lastFm = new Lastfm\LastfmSearch();
    echo 'Some words about';
} else {
    echo 'Some other words';
}
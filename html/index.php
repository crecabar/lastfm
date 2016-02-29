<?php
/**
 * File index.php
 *
 * PHP version 5
 *
 * @category PHP
 * @package  none
 * @author   Cristian Recabarren <crecabar_cl@me.com>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GPL2
 * @link     https://github.com/crecabar/lastfm
 */

require_once __DIR__ . '/../config/Config.php';
use Config\Config;
use Lib\Lastfm;

$config = Config::getInstance();

$content = "";
$content .= \Includes\Helpers::render('templates/header');
$content .= \Includes\Helpers::render('templates/search-form');

$keyword = filter_input(INPUT_GET, 'keyword');  // PHP 5.4.40 claims against to have this sentence inside the if
                                                // sentence, but in PHP 5.5.20 is allowed.
if (!empty($keyword)) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ? : 1; //TODO: add pager management.
    $lastFm = new Lastfm\LastfmSearch(['page_number' => $page]);
    $content .= \Includes\Helpers::render(
        'templates/list',
        ['artists' => $lastFm->run($keyword), 'country' => $keyword]
    );
    $paginationData = $lastFm->getPaginationData();
    $content .= \Includes\Helpers::render(
        'templates/pager',
        [
            'page' => $page,
            'totalPages' => $paginationData['totalPages'],
            'keyword' => $keyword
        ]
    );
}

$content .= \Includes\Helpers::render('templates/footer');

echo \Includes\Helpers::render('template', ['content' => $content]);
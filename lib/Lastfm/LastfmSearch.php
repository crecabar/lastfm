<?php
/**
 * File LastfmSearch.php
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Lib\Lastfm
 * @author   Cristian Recabarren <crecabar_cl@me.com>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GPL2
 * @link     https://github.com/crecabar/lastfm
 */

namespace Lib\Lastfm;

/**
 * Class LastfmSearch
 *
 * @category PHP
 * @package  Lib
 * @author   Cristian Recabarren <crecabar_cl@me.com>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GPL2
 * @link     https://github.com/crecabar/lastfm
 */
class LastfmSearch extends \Lib\Lastfm
{

    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->page_size = \Config\Config::getInstance()->lastFm['page_size'];
        $this->page = isset($params['page_number']) ? (int)$params['page_number'] : 1;
        parent::__construct();
    }

    /**
     *
     */
    protected function setMethod()
    {
        $this->method = 'geo.gettopartists';
    }

    /**
     * @param null $query
     * @return array
     */
    public function run($query = null)
    {
        $keyword = filter_var($query, FILTER_SANITIZE_MAGIC_QUOTES);
        $params = [
            'country' => $keyword,
            'limit' => $this->page_size,
            'page' => $this->page
        ];
        $lastfmArtists = [];
        $xmlResult = simplexml_load_string(file_get_contents($this->buildUrl($params)));
        $this->setAttributes(reset($xmlResult->topartists->attributes()));
        foreach ($xmlResult->topartists->artist as $artist) {
            $lastfmArtists[] = new \Lib\LastfmArtist($artist);
        }
        return $lastfmArtists;
    }

    /**
     * @param array $attributes
     */
    private function setAttributes(array $attributes = [])
    {
        foreach ($attributes as $attr => $value) {
            if ($this->isValidAttr($attr)) {
                $this->$attr = $value;
            }
        }
    }

    /**
     * @param string $attr
     * @return bool
     */
    private function isValidAttr($attr)
    {
        return in_array($attr, ['page', 'pages', 'perpage', 'total']);
    }

    /**
     * @return array
     */
    public function getPaginationData()
    {
        return [
            'page' => $this->$page,
            'pages' => $this->$pages,
            'perpage' => $this->$perpage,
            'total' => $this->$total
        ];
    }
}

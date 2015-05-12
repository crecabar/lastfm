<?php

namespace Lib\Lastfm;

/**
 * Description of LastfmSearch
 *
 * @author crecabar
 */
class LastfmSearch extends \Lib\Lastfm
{
    
    public function __construct()
    {
        $this->page_size = \Config\Config::getInstance()->lastFm['page_size'];
        $this->page = isset($params['page_number']) ? (int)$params['page_number'] : 1;
        parent::__construct();
    }

    
    protected function setMethod()
    {
        $this->method = 'geo.gettopartists';
    }

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
            $lastfmArtists[] = new \Lib\LastfmArtist(reset($artist->attributes()));
        }
        return $lastfmArtists;
    }
    
    private function setAttributes(array $attributes = [])
    {
        foreach($attributes as $attr => $value) {
            if ($this->isValidAttr($attr)) {
                $this->$attr = $value;
            }
        }
    }
    
    private function isValidAttr($attr)
    {
        return in_array($attr, ['page', 'pages', 'perpage', 'total']);
    }
    
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

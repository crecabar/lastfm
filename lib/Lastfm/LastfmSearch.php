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
        $xmlResult = simplexml_load_string(file_get_contents($this->buildUrl($params)));
        return $xmlResult;
    }

}

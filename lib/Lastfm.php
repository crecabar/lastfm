<?php

namespace Lib;

abstract class Lastfm
{
    protected $key;
    protected $secret;
    protected $baseUrl = 'http://ws.audioscrobbler.com/2.0/';
    protected $method;
    protected $format;
    
    public function __construct()
    {
        $this->key = \Config\Config::getInstance()->lastFm['key'];
        $this->secret = \Config\Config::getInstance()->lastFm['secret'];
        $this->format = 'xml';
        $this->setMethod();
    }
    
    abstract protected function setMethod();
    
    protected function buildUrl(array $params = [])
    {
        $params['method'] = $this->method;
        $params['api_key'] = $this->key;
        $params['format'] = $this->format;
        return $this->baseUrl . http_build_query($params);
    }
    
    abstract public function run($params = null);
}
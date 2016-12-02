<?php
/**
 * File Lastfm.php
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Lib
 * @author   Cristian Recabarren <crecabar_cl@me.com>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GPL2
 * @link     https://github.com/crecabar/lastfm
 */

namespace Lib;
use \Config\Config;

/**
 * Class Lastfm
 *
 * @category PHP
 * @package  Lib
 * @author   Cristian Recabarren <crecabar_cl@me.com>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GPL2
 * @link     https://github.com/crecabar/lastfm
 */
abstract class Lastfm
{
    protected $key;
    protected $secret;
    protected $baseUrl = 'http://ws.audioscrobbler.com/2.0/';
    protected $method;
    protected $format;

    /**
     * Constructor
     *
     * @param Config $config
     */
    public function __construct(Config $config, array $params = [])
    {
        $this->key = $config->lastFm['key'];
        $this->secret = $config->lastFm['secret'];
        $this->format = 'xml';
        $this->setMethod();
    }//end __construct()

    /**
     * Method: setMethod
     * Abstract method, should be implemented by non abstract classes
     *
     * @return void
     */
    abstract protected function setMethod();

    /**
     * Method: buildUrl
     *
     * @param  Array $params The list of params to build the url
     * @return String
     */
    protected function buildUrl(array $params = [])
    {
        $params['method'] = $this->method;
        $params['api_key'] = $this->key;
        //$params['format'] = $this->format;
        return $this->baseUrl . '?' . http_build_query($params);
    }//end buildUrl()

    /**
     * Method: run
     * Abstract method, should be implemented by non abstract classes
     *
     * @param  Array $params The params to run the method set on setMethod
     * @return void
     */
    abstract public function run($params = null);
}//end class

<?php
/**
 * File Config.php
 *
 * @category PHP
 * @package  Config
 * @author   Cristian Recabarren <crecabar_cl@me.com>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GPL2
 * @link     https://github.com/crecabar/lastfm
 */

namespace Config;

/**
 * Class Config
 *
 * @category PHP
 * @package  Config
 * @author   Cristian Recabarren <crecabar_cl@me.com>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GPL2
 * @link     https://github.com/crecabar/lastfm
 */
class Config
{
    /**
     * @var $instance Config It represents the only one instance of the class.
     */
    private static $instance = null;

    /**
     *
     */
    private function __construct()
    {
        require_once 'Psr4AutoloaderClass.php';
        $this->loader = new Psr4AutoloaderClass();
        $this->loader->register();
        $this->loader->addNamespace('Includes', __DIR__ . '/../includes');
        $this->loader->addNamespace('Lib', __DIR__ . '/../lib');
        $this->loader->addNamespace('App', __DIR__ . '/../app');
        $this->parseIni();
    }

    /**
     * @return Config
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }

    /**
     *
     */
    private function parseIni()
    {
        foreach (parse_ini_file('config.ini') as $key => $value) {
            $this->$key = $value;
        }
    }
}

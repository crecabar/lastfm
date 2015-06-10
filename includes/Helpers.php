<?php
/**
 * File Helpers.php
 *
 * @category PHP
 * @package  Includes
 * @author   Cristian Recabarren <crecabar_cl@me.com>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GPL2
 * @link     https://bitbucket.org/crecabarren/last.fm-api-v2
 */

namespace Includes;
use Config\Config;

/**
 * Class Helpers
 *
 * @category PHP
 * @package  Includes
 * @author   Cristian Recabarren <crecabar_cl@me.com>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GPL2
 * @link     https://bitbucket.org/crecabarren/last.fm-api-v2
 */
class Helpers
{
    /**
     * @param  string $template
     * @param  array  $data
     * @return string
     */
    public static function render($template, $data = array())
    {
        $path = __DIR__ . Config::getInstance()->views['path'] . $template . '.php';
        if (file_exists($path)) {
            extract($data);
            ob_start();
            include $path;
            return ob_get_clean();
        }
    }

    /**
     * @param  string $url
     * @param  array  $params
     * @param  string $text
     * @return string
     */
    public static function printLink($url, $text, array $params = [])
    {
        $pars = "";
        foreach ($params as $key => $value) {
            $pars .= $key . '=' . '"' . $value . '"';
        }
        return '<a href="' . $url . '"' . $pars . '>' . $text . '</a>';
    }

    /**
     * @param  string $imgSrc
     * @return string
     */
    public static function printImg($imgSrc)
    {
        return '<img src="' . $imgSrc . '">';
    }
}

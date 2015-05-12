<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Includes;
use Config\Config;

/**
 * Description of Helpers
 *
 * @author crecabar
 */
class Helpers
{
    public static function render($template, $data = array())
    {
        $path = __DIR__ . Config::getInstance()->views['path'] . $template . '.php';
        if (file_exists($path)) {
            extract($data);
            require($path);
        }
    }
}

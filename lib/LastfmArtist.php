<?php
/**
 * File LastfmArtist.php
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Lib
 * @author   Cristian Recabarren <crecabar_cl@me.com>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GPL2
 * @link     https://bitbucket.org/crecabarren/last.fm-api-v2
 */

namespace Lib;

/**
 * Class LastfmArtist
 *
 * @category PHP
 * @package  Lib
 * @author   Cristian Recabarren <crecabar_cl@me.com>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GPL2
 * @link     https://bitbucket.org/crecabarren/last.fm-api-v2
 */
class LastfmArtist
{

    /**
     * @param \SimpleXMLElement $simpleXML
     */
    public function __construct(\SimpleXMLElement $simpleXML)
    {
        foreach (get_object_vars($simpleXML) as $key => $value) {
            if ($this->isValidKey($key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @param  $key
     * @return bool
     */
    public function isValidKey($key)
    {
        return
            in_array(
                $key,
                [
                    'name',
                    'listeners',
                    'mbid',
                    'url',
                    'streamable',
                    'image'
                ]
            );
    }

    /**
     * @param  string $property
     * @return mixed
     */
    public function getProperty($property)
    {
        if ($this->isValidKey($property)) {
            return $this->$property;
        }
    }

    /**
     * @param  int   $position
     * @return mixed
     */
    public function getImage($position = 0)
    {
        return $this->image[$position];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}

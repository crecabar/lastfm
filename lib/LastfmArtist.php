<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

/**
 * Description of LastfmArtist
 *
 * @author crecabar
 */
class LastfmArtist
{
    public function __construct($simpleXML)
    {
        foreach (get_object_vars($simpleXML) as $key => $value) {
            if ($this->isValidKey($key)) {
                $this->$key = $value;
            }
        }
    }
    
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
    
    public function getProperty($property)
    {
        if($this->isValidKey($property)) {
            return $this->$property;
        }
    }


    public function getImage($position = 0)
    {
        return $this->image[$position];
    }


    public function __toString() {
        return $this->name;
    }
    
}

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
    public function __construct(array $params = [])
    {
        foreach ($params as $key => $value) {
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
                    'playcount',
                    'mbid',
                    'url',
                    'streamable'
                ]
            );
    }
    
}

<?php

/*
 * This file is part of the Stingray package.
 *
 * (c) Matthew Ratzke <matthew.003@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace projectmeta\Stingray;

use projectmeta\Stingray\Exception\ArrayNodeNotFoundException;

/**
 * Stingray.
 *
 * Get or Set array node using dot notation.
 * 
 * @author Matthew Ratzke <matthew.003@me.com>
 */
class Stingray
{

    /**
     * Get array node.
     * 
     * Get's an array node using dot notation.
     * 
     * @param &$data Array being searched
     * @param $string String used to search array
     * 
     * @return Array Node
     */
    public function get(&$data, $string)
    {

        return $this->iterateNode($data, $string);
        
    }

    /**
     * Set array node.
     * 
     * Set's an array node using dot notation.
     * 
     * @param &$data Array being searched
     * @param $string String used to search array
     * @param $val Value to set array node
     */
    public function set(&$data, $string, $val)
    {
        
        $node =& $this->iterateNode($data, $string);
        
        $node = $val;
        
    }
    
    /**
     * Iterate through array
     * 
     * Iterate through array using dot delimited string
     * 
     * @param &$data Array being searched
     * @param $string String used to search array
     * 
     * @return $node Array Node
     */
    private function &iterateNode(&$data, $string)
    {
        
        $paths = explode('.', $string);
        
        $node =& $data;
        
        foreach ($paths as $path)
        {
            
            if (array_key_exists($path, $node))
            {
                
                $node =& $node[$path];
            
            } else
            {
                
                throw new ArrayNodeNotFoundException($path, $string);
                
            }
            
        }
        
        return $node;

    }
}
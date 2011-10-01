<?php
/**
 * Main Helper Class
 *
 * @category   Blog Bundle
 * @package    Helpers
 * @copyright  2011 jorgemeireles.com - Jorge Meireles
 * @license    Simplified BSD
 * @author     Jorge Meireles (info@jorgemeireles.com)
 * 
 * Methods:
 * 
 *  - Slugify: 
 *       ex: FaiancaCore::slugify($text);
 * 
 *  - dataFormat
 *      ex : FaiancaCore::dateFormat('now');
 */
namespace Faianca\BlogBundle\Helper;

class FaiancaCore {
    
    /**
     * source : http://snipplr.com/view/22741/slugify-a-string-in-php/
     *
     * @static
     * @param  $text
     * @return mixed|string
     */
    static public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }
    
    /**
     * Sets the date this entity was created
     *
     * @throws \InvalidArgumentException
     * @param \DateTime|string|integer $date
     * @return date
     */
    static function dateFormat($date){
        
        if (is_string($date)) {
            $date = new \DateTime($date);
        } else if (is_int($date)) {
            $date = new \DateTime(sprintf('@%d', $date));
        } else if (!$date instanceof \DateTime) {
            throw new \InvalidArgumentException(sprintf(
                'Expecting string, integer or DateTime, but got `%s`',
                is_object($date) ? get_class($date) : gettype($date)
            ));
        }
        
        return $date;
    }
    
    /**
     * Quick debugging of any variable. Any number of parameters can be set.
     *
     * @return  string
     */
    public static function debug(){
            if (func_num_args() === 0)
                    return;

            // Get params
            $params = func_get_args();
            $output = array();

            foreach ($params as $var)
            {
                    $output[] = '<pre>('.gettype($var).') '.html::specialchars(print_r($var, TRUE)).'</pre>';
            }

            return implode("\n", $output);
    }
     


    
}
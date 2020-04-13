<?php


namespace App\Utility;

/**
 * Class Text.
 *
 * @package App\Utility
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Text
{
    /**
     * @var array
     */
    private static $_texts = array();

    /**
     * Get: Returns $key value, otherwise an empty string when $key
     * cannot not be found on the text configuration.
     *
     * @access public
     *
     * @param string $key
     * @param array  $data [optional]
     *
     * @return mixed|string|string[]
     * @since 1.0
     */
    public static function get(string $key, array $data = [])
    {
        if (empty(self::$_texts)) {
            $texts = Config::get("TEXTS");
            self::$_texts = is_array($texts) ? $texts : array();
        }

        // Check if parsed $key exists in the array $_texts.
        if (array_key_exists($key, self::$_texts)) {
            $text = self::$_texts[$key]; // Grabbing the $key value.
            foreach ($data as $index => $value) {
                $text = str_replace($index, $value, $text);
            }
            return $text;

        }
        return "";


    }

}
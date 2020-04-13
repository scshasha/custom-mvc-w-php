<?php


namespace App\Utility;

/**
 * Class Config
 * @package App\Utility
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Config
{

    private static $_config = array();

    /**
     * Get: Returns value of the specified $key from the app
     * configuration file, otherwise nothing
     * @access public
     * @param string $key
     * @return mixed|null
     * @since 1.0
     */
    public static function get($key)
    {
        if (empty(self::$_config)) {
            self::$_config = require_once APP_CONFIG_FILE;
        }
        return array_key_exists($key, self::$_config) ? self::$_config[$key] : null;
    }

}
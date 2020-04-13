<?php


namespace App\Utility;

/**
 * Class Cookie
 * @package App\Utility
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Cookie
{
    /**
     * Get:
     * @access public
     * @param string $key
     * @return mixed
     * @since 1.0
     */
    public static function get(string $key)
    {
        return $_COOKIE[$key];
    }

    /**
     * @param string               $key
     * @param string               $value
     * @param \App\Utility\integer $expiry
     *
     * @return bool
     * @since 1.0
     */
    public static function put(string $key, string $value, integer $expiry)
    {
        return setcookie($key, $value, time() + $expiry, "/");
    }
    /**
     * Delete:
     * @access public
     * @param string $key
     * @return void
     * @since 1.0
     */
    public static function delete(string $key)
    {
        self::put($key, "", time() - 1);
    }

    /**
     * Exists:
     * @access public
     * @param string $key
     * @return bool
     * @since 1.0
     */
    public static function exists(string $key)
    {
        return isset($_COOKIE[$key]);
    }


}
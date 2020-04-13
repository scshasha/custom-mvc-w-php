<?php


namespace App\Utility;

/**
 * Class Session.
 *
 * @package App\Utility
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Session
{
    /**
     * Init.
     *
     * @access public
     * @return void
     * @since 1.0
     */
    public static function init()
    {
        if (session_id() == "") {
            session_start();
        }
    }

    /**
     * Put.
     *
     * @access public
     *
     * @param $key
     * @param $value
     *
     * @return mixed
     * @since 1.0
     */
    public static function put($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    /**
     * Exists
     *
     * @access public
     *
     * @param $key
     *
     * @return bool
     * @since 1.0
     */
    public static function exists($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Get
     *
     * @access public
     *
     * @param $key
     *
     * @return mixed
     * @since 1.0
     */
    public static function get($key)
    {
        if (self::exists($key)) {
            return $_SESSION[$key];
        }
    }

    /**
     * Delete
     *
     * @access public
     *
     * @param $key
     *
     * @return bool
     * @since 1.0
     */
    public static function delete($key)
    {
        if (self::exists($key)) {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }

    /**
     * Destroy
     *
     * @access public
     * @return void
     * @since 1.0
     */
     public static function destroy()
     {
         session_destroy();
     }
}
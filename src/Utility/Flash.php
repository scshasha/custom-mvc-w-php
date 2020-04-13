<?php


namespace App\Utility;

/**
 * Class Flash
 *
 * @package App\Utility
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Flash
{
    /**
     * Session:
     * @access public
     *
     * @param string $key
     * @param string $value [optional]
     *
     * @return string|null
     * @since 1.0
     */

    // @todo: Check if this should be a static or not.
    public static function session($key, $value = "")
    {
        if (Session::exists($key)) {
          $session = Session::get($key);
          Session::delete($key);
          return $session;
        } elseif (!empty($value)) {
            return Session::put($key, $value);
        }
        return null;
    }

    /**
     * Danger:
     *
     * @access public
     *
     * @param string $value
     *
     * @return string|null
     * @since 1.0
     */
    public static function danger($value = "")
    {
        return self::session(Config::get("SESSION_FLASH_DANGER"), $value);
    }

    /**
     * Info:
     *
     * @access public
     *
     * @param string $value
     *
     * @return string|null
     * @since 1.0
     */
    public static function info($value = "")
    {
        return self::session(Config::get("SESSION_FLASH_INFO"), $value);
    }

    /**
     * Success:
     *
     * @access public
     *
     * @param string $value
     *
     * @return string|null
     * @since 1.0
     */
    public static function success($value = "")
    {
        return self::session(Config::get("SESSION_FLASH_SUCCESS"), $value);
    }

    /**
     * Warning:
     *
     * @access public
     *
     * @param string $value
     *
     * @return string|null
     * @since 1.0
     */
    public static function warning($value = "")
    {
        return self::session(Config::get("SESSION_FLASH_WARNING"), $value);
    }

}
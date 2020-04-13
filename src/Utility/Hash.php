<?php


namespace App\Utility;

/**
 * Class Hash
 *
 * @package App\Utility
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Hash
{
    /**
     * Generate:
     *
     * @access public
     *
     * @param        $string
     * @param string $salt
     *
     * @return string
     * @since 1.0
     */
    public static function generate($string, $salt = "")
    {
        return hash("sha256",$string . $salt);
    }

    /**
     * Generate Unique:
     *
     * @access public
     * @return string
     * @since 1.0
     */
    public static function generateUnique() {
        return self::generate(uniqid());
    }

    /**
     * Generate Salt:
     *
     * @access public
     *
     * @param $length
     *
     * @return string
     * @since 1.0
     */
    public static function generateSalt($length)
    {
        $salt = "";
        $charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\\][{}\'\";:?.><,!@#$%^&*()_-=+|";
        for($i = 0; $i < $length; $i++) {
            $salt .= $charset[mt_rand(0, strlen($charset) - 1)];
        }
        return $salt;
    }

}
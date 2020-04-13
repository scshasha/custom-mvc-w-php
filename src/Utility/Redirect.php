<?php


namespace App\Utility;

/**
 * Class Redirect.
 *
 * @package App\Utility
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Redirect
{
    /**
     * To:
     * @access public
     *         
     * @param string $location
     *
     * @return void
     * @since 1.0
     */
    public static function to($location = "")
    {
        if ($location) {
            if ($location === 404) {
                header('HTTP/1.0 404 Not Found');
                include VIEW_PATH.DEFAULT_404_PATH;
            } else {
                header("Location: " . $location);
            }
            exit();
        }
    }

}
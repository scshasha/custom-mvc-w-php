<?php


namespace App\Utility;

/**
 * Class Auth
 * @package App\Utility
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Auth
{

    /**
     * Check Auth: Checks if the user is authenticated, destroying
     * and redirecting if session does not exist
     * @access public
     * @param string $redirect
     * @since 1.0
     */
    public static function checkAuthenticated($redirect = "login")
    {

        Session::init();
        if (!Session::exists(Config::get("SESSION_USER"))) {
            /**
             * We cannot send a message to the UI since the session doesn't exist
             */
            Session::destroy(); // Destroy all sessions
            Redirect::to(APP_URL.$redirect); // Redirect to the login page.
        }

    }


    /**
     * Check Unauthenticated: Checks if the user is unauthenticated, redirecting
     * to a location if user session exists
     * @access public
     * @param string $redirect
     * @since 1.0
     */
    public static function checkUnauthenticated($redirect = "")
    {
        Session::init();
        if (Session::exists(Config::get("SESSION_USER"))) {
            Redirect::to(APP_URL.$redirect);
        }
    }

    public static function checkAuthenticatedAdmin(string $redirect = "login")
    {

        // Check if this user is logged in
        Session::init();

        if (!Session::exists(Config::get("SESSION_USER"))) {
            Session::destroy();
            Redirect::to(APP_URL.$redirect);
        }

        // Check if they are an administrator
        if  (\App\Model\User::getInstance(Session::get(Config::get("SESSION_USER")))->data()->user_role !== "ADMIN") {
            Flash::warning(Text::get("USER_ACCESS_DENIED"));
            Redirect::to(APP_URL.$redirect);
        }


    }

}
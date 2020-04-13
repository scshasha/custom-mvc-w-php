<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Class Login
 * @package App\Controller
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Login extends Core\Controller
{
    /**
     * Index: Render the login view.
     * @access public
     * @example login/index
     * @return void
     * @since 1.0
     */
    public function index()
    {
        // Check auth.
        Utility\Auth::checkUnauthenticated();

        // Render the login view.
        $this->View->render("login/index", [
            "title" => "Login",
        ]);
    }


    /**
     * Login: Processes a login request.
     *
     * @access  public
     * @return void
     * @throws \Exception
     * @since   1.0
     * @example login/_login
     */
    public function _login()
    {
        // Check auth.
        Utility\Auth::checkUnauthenticated();


        // Process login request, redirect to home or login.
        if (Model\UserLogin::login()) {
            Utility\Redirect::to(APP_URL);
        }
        Utility\Redirect::to(APP_URL."login");
    }

    /**
     * Login With Cookie: Processes a login with cookie request.
     * @access public
     * @example login/_loginWithCookie
     * @return void
     * @since 1.0
     */
    public function _loginWithCookie()
    {
        // Check auth.
        Utility\Auth::checkUnauthenticated();

        // Process login with cookie request, redirect to home or login.
        if (Model\UserLogin::loginWithCookie()) {
            Utility\Redirect::to(APP_URL);
        }
        Utility\Redirect::to(APP_URLL."login");
    }

    /**
     * Logout: Processes the logout request.
     * @access public
     * @example login/logout
     * @return void
     * @since 1.0
     */
    public function logout()
    {
        // Check auth.
        Utility\Auth::checkAuthenticated();

        
        // Process the logout request.
        if (Model\UserLogin::logout()) {
            Utility\Redirect::to(APP_URL."login");
        }
        Utility\Redirect::to(APP_URL);
    }
}

<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Class Register
 *
 * @package App\Controller
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Register extends Core\Controller
{
    /**
     * Index: Render the register view.
     * @access public
     * @example register/index
     * @return void
     * @since 1.0
     */
    public function index()
    {
        // Check auth.
        Utility\Auth::checkUnauthenticated();

        // Set data and render view.
        $this->View->render("register/index", [
            "title" => "Registration",
        ]);
    }

    /**
     * Register: Processes an account creation request.
     * @access public
     * @example register/_register
     * @return void
     * @since 1.0
     */
    public function _register()
    {
        // Check authenticated.
        Utility\Auth::checkUnauthenticated();

        // Process the register request, redirect to the login controller
        // register if unsuccessful
        if (Model\UserRegister::register()) {
            Utility\Redirect::to(APP_URL."login");
        }
        Utility\Redirect::to(APP_URL."register");
    }

}
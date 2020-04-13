<?php
/**
 * @file index.
 */

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Class Index
 * @package App\Controller
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Index extends Core\Controller
{
    /**
     * Default: Renders default view.
     * @access public
     * @example index/index
     * @return void
     * @since 1.0
     */
    public function index()
    {
        // Check auth.
        Utility\Auth::checkAuthenticated();

        // Get instance of user model using ID in session.
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
        if (!$User = Model\User::getInstance($userID)) {
            Utility\Redirect::to(APP_URL);
        }

//
//        echo "<pre>";
//        var_dump();
//        die();
        // Set dependencies, data and render the view.
        // @todo: Remove the css and js stuff if not needed
        $this->View->addCSS("css/index.css");
        $this->View->addJS("js/index.jquery.js");


        $this->View->render("index/index", [
            "title" => "Home",
            "user" => $User->data(),
        ]);
    }
}



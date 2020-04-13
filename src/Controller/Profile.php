<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;
use App\Presenter\Profile as ProfileFormatter;

/**
 * Class Profile
 * @package App\Controller
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Profile extends Core\Controller
{
    /**
     * Index: Render the profile view.
     * @access public
     * @example profile/index/{$1}
     * @param string $user [optional]
     * @return void
     * @since 1.0
     */
    public function index($user="")
    {
        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        Utility\Auth::checkAuthenticatedAdmin();

        // If no user ID has been passed, and a user session exists, display
        // the authenticated users profile.
        if (!$user) {
            $userSession = Utility\Config::get("SESSION_USER");
            if (Utility\Session::exists($userSession)) {
                $user = Utility\Session::get($userSession);
            }
        }

        // Get an instance of the user model using the user ID passed to the
        // controll action. 
        if (!$User = Model\User::getInstance($user)) {
            Utility\Redirect::to(APP_URL);
        }

        // Set any dependencies, data and render the view.
        $this->View->render("profile/index", [
            "title" => "Profile",
            "data" => (new ProfileFormatter($User->data()))->present(),
            "user" => $User->data(), /** (new ProfileFormatter($User->data()))->present() */
        ]);
    }

    public function edit($user = "")
    {
        // Check authorization
        Utility\Auth::checkAuthenticated();

        if (!$user) {
            // Display the authenticated profile in session.
            $session = Utility\Config::get("SESSION_USER");
            $ID = (int) Utility\Session::get($session); // Grabbing user ID from the session storage
            if (!$User = Model\User::getInstance($ID)) {
                Utility\Redirect::to(sprintf("%s/profile/edit/%d", AP_URL, $ID));
            }
        } elseif($user) {
            // Get user by username / email / ID
            if (!$User = Model\User::getInstance($user)) {
                Utility\Redirect::to(APP_URL);
            }

        }

        $this->View->render("profile/edit", [
            "title" => "Edit Profile",
            "user" => (new ProfileFormatter($User->data()))->present()
        ]);

    }

}
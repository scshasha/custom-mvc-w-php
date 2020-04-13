<?php


namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Class Dasboard
 * @package App\Controller
 * 
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Dashboard extends Core\Controller
{

    public function index()
    {
        // Only Administrators can view this view
        Utility\Auth::checkAuthenticatedAdmin();

        // Admin data.
        $User = Model\User::getInstance(
            Utility\Session::get(
                Utility\Config::get("SESSION_USER")
            )
        );

        /** Get al users that are not Admins */

        return $this->View->render("dashboard/index", [
            "title" => "Administrator",
            "user" => $User->data(),
            "members" => (object) array(
                array("id" => 3,"firstname"=>"Sivuyile", "lastname"=>"Shasha", "email"=> "scshasha@icloud.com", "role"=>"","gender"=>"M"),
                array("id" => 4,"firstname"=>"Sange", "lastname"=>"Ludlolo", "email"=> "sange.l@icloud.com", "role"=>"","gender"=>"M"),
                array("id" => 5,"firstname"=>"Tamara", "lastname"=>"Lockhart", "email"=> "tamara@icloud.com", "role"=>"ADMIN","gender"=>"F"),
                array("id" => 1,"firstname"=>"Dumisani", "lastname"=>"Kiyisane", "email"=> "kdumisani@icloud.com", "role"=>"","gender"=>"M"),
            ),
        ]);

    }

}
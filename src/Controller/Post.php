<?php
/**
 * @file about.
 */

namespace App\Controller;

use App\Core;
use App\Model;
use App\Presenter\Profile as ProfileFormatter;
use App\Utility;

/**
 * Class Post
 * @package App\Controller
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Post extends Core\Controller
{
    /**
     * Default: Renders posts view.
     * @access public
     * @example post/index
     * @return void
     * @since 1.0
     */
    public function index()
    {
        // Check authenticated.
        Utility\Auth::checkAuthenticated();

        // Grab the authenticated user.
        $User = Model\User::getInstance(
            Utility\Session::get(
                Utility\Config::get("SESSION_USER")
            )
        );


        // Not need to be logged in to view this route.
        // Set dependencies, data and render the view.
        // @todo: Remove the css and js stuff if not needed
        $this->View->addCSS("css/blog-post.css");
        $this->View->addJS("js/index.jquery.js");

        $this->View->render("post/index", [
            "title" => "Posts",
            "user" =>(new ProfileFormatter($User->data()))->present(),
        ]);
    }
    

    /**
     * Single: Renders a single post view.
     * @access public
     * @example post/index/{id}
     * @return void
     * @since 1.0
     */
    public function _single($postID)
    {
        // Check auth.
        Utility\Auth::checkUnauthenticated();

        $this->View->render("post/single", [
            "title" => "Posts",
            "data" => array(),
        ]);
    }


}
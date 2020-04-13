<?php


namespace App\Core;


use App\Utility;
//use App\Core\View;

/**
 * Class Controller
 * @package App\Core
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Controller
{
    /**
     * @var mixed|null
     */
    protected $View = null;

    /**
     * Controller constructor: Create and stores a new instance of the core view class.
     * @access public
     * @since 1.0
     */
    public function __construct()
    {
        Utility\Session::init();

        if (Utility\Input::get("url") !== "login/_loginWithCookie") {
            $cookie = Utility\Config::get("COOKIE_USER");
            $session = Utility\Config::get("SESSION_USER");
            if (!Utility\Session::exists($session) && Utility\Cookie::exists($cookie)) {
                Utility\Redirect::to(APP_URL."login/_loginWithCookie");
            }
        }

        $this->View = new View;
    }

}
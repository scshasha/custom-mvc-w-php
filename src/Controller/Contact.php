<?php


namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Class Contact
 * @package App\Controller
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Contact extends Core\Controller
{

    /**
     * Default: Renders contact view.
     * @access public
     * @example contact/index
     * @return void
     * @since 1.0
     */
    public function index()
    {
        $this->View->render("contact/index", [
            "title" => "Contact",
            "data" => array('content' => "Content page data."),
        ]);
    }


}
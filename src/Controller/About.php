<?php


namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Class About
 * @package App\Controller
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class About extends Core\Controller
{

    /**
     * Default: Renders about view.
     * @access public
     * @example about/index
     * @return void
     * @since 1.0
     */
    public function index()
    {
        $this->View->render("about/index", [
            "title" => "About",
            "data" => array('content' => "About page data."),
        ]);
    }


}
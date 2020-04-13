<?php


namespace App\Presenter;

use App\Core;

/**
 * Class Profile
 * @package App\Presenter
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Profile extends Core\Presenter
{
    /**
     * Format:
     * @access public
     * @return array
     * @since 1.0
     */
    public function format()
    {
        return array(
            "name" => sprintf("%s %s",$this->data->firstname, $this->data->lastname),
            "firstname" => $this->data->firstname,
            "lastname" => $this->data->lastname,
            "id" => $this->data->id,
            "email" => $this->data->id,
        );
    }

}
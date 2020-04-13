<?php


namespace App\Core;

/**
 * Class Presenter
 * @package App\Core
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Presenter
{
    /**
     * @var null
     */
    protected $data = null;

    /**
     * Presenter constructor.
     * @access public
     * @param mixed $data
     * @since 1.0
     */
    public function __construct($data = array())
    {
        $this->data = (Object) $data;
    }

    /**
     * Present:
     * @access public
     * @return object
     * @since 1.0
     */
    public function present()
    {
        return((Object) $this->format());
    }
}
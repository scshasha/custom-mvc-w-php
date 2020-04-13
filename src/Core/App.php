<?php


namespace App\Core;

use Exception;
use ReflectionClass;
use ReflectionMethod;
use App\Utility\Input;
use App\Utility\Redirect;

/**
 * Class App
 * @package App\Core
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class App
{
    /**
     * @var mixed
     */
    private $_class = DEFAULT_CONTROLLER;
    /**
     * @var string
     */
    private $_method = DEFAULT_CONTROLLER_ACTION;
    /**
     * @var array
     */
    private $_params = [];
    /**
     * @var bool
     */
    private $_isProfileEdit = false;

    /**
     * App constructor: Processes the app, parses the url
     * and sets method and method parameters.
     * @access public
     * @since 1.0
     */
    public function __construct()
    {

        $this->_parseURL();
        try {
            $this->_getClass();
            $this->_getMethod();
            $this->_getParams();
        } catch (Exception $exception) {
            Redirect::to(404);
        }

    }



    /**
     * Get Method: Checks if the second URL element is set and not empty,
     * replaces the default controller method if it exists
     * @access private
     * @return void
     * @since 1.0
     * @throws Exception
     */
    private function _getMethod() {

        if (isset($this->_params[1]) && !empty($this->_params[1])) {
            $this->_method = $this->_params[1];
            unset($this->_params[1]);
        }

        if (!(new ReflectionClass($this->_class))->hasMethod($this->_method)) {
            throw new Exception(("The controller method {$this->_method} does not exist!"));
        }

        if (!(new ReflectionMethod($this->_class, $this->_method))->isPublic()) {
            throw new Exception("The controller method {$this->_method} is not accessible!");
        }
    }



    /**
     * Get Class: Checks if the first URL element is set and not empty,
     * replaces the default controller class if it exists, replace with
     * new instance of the class
     * @access private
     * @return void
     * @since 1.0
     * @throws Exception
     */
    private function _getClass()
    {

        if (isset($this->_params[0]) && !empty($this->_params[0])) {
            $this->_class = CONTROLLER_PATH . ucfirst(strtolower($this->_params[0]));
            /**
             * ===============================================================================================
             * NOTE: This is a hack to enable user profile editing functionality.
             * We want to force the following url syntax /profile/edit/{id}.
             *
             * where:
             * profile  => the controller
             * edit     => the method action
             * {id}     => the record ID as a request param
             * ===============================================================================================
             */
            switch (strtolower($this->_params[0])) {
                case 'profile':
                    $this->_isProfileEdit = true;
                    if (count($this->_params) > 3) {
                        $this->_params[1] = $this->_params[2];
                        $this->_params[2] = $this->_params[3];
                        unset($this->_params[3]);
                    }
                    break;
            }
            /**
             * ===============================================================================================
             * End hack.
             * ===============================================================================================
             */

            unset($this->_params[0]);
        }

        if (!class_exists($this->_class)) {
            throw new Exception("The controller {$this->_class} does not exist!");
        }

        $this->_class = new $this->_class;
    }

    /**
     * Run: Class the controller and method with params.
     * @access public
     * @return void
     * @since 1.0
     */
    public function run() {
//        echo "<pre>";
//        var_dump($this->_params);
//        var_dump($this->_method);
//        var_dump($this->_class);
//        die();
        call_user_func_array(array($this->_class, lcfirst($this->_method)), $this->_params);
    }


    /**
     * Parse URL: Gets URL string elements
     * @access private
     * @return void
     * @since 1.0
     */
    private function _parseURL() {
//        var_dump(Input::get("url"));die();
        if (($url = Input::get("url"))) {
            // Assign a trimmed, sanitised and exploded string.
            $this->_params = explode("/", filter_var(rtrim($url, "/"), FILTER_SANITIZE_URL));
        }
    }


    /**
     * Get Params: Checks if the URL has any remaining elements
     * @access private
     * @return void
     * @since 1.0
     */
    private function _getParams() {
        $this->_params = $this->_params ? array_values($this->_params) : array();
    }

}
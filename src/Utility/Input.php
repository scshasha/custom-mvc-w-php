<?php


namespace App\Utility;

/**
 * Class Input
 *
 * @package App\Utility
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Input
{
    /**
     * Get:
     *
     * @access public
     *
     * @param        $key
     * @param string $default
     *
     * @return mixed|string
     * @since 1.0
     */
    public static function get($key, $default = "")
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }

    /**
     * Post:
     *
     * @access public
     *
     * @param        $key
     * @param string $default
     *
     * @return mixed|string
     * @since 1.0
     */
    public static function post($key, $default = "")
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    /**
     * Check:
     *
     * @access public
     *
     * @param array $source
     * @param array $inputs
     * @param null  $rowID
     *
     * @return bool
     * @since 1.0
     */
    public static function check(array $source, array $inputs, $rowID = null)
    {
        if (!Input::exists()) {
            return false;
        }
        if (!isset($source["csrf_token"]) && !Token::check($source["csrf_token"])) {
            Flash::danger(Text::get("INPUT_INCORRECT_CSRF_TOKEN"));
            return false;
        }

        return true;
        $Validate = new Validate($source, $rowID);
        $validation = $Validate->check($inputs);

        if (!$validation->passed()) {
            Session::put(Config::get("SESSION_ERRORS"), $validation->errors());
            return false;
        }

        return true;

    }

    /**
     * Exists:
     * @access public
     *
     * @param string $source
     *
     * @return bool
     * @since 1.0
     */
    public static function exists($source = "post")
    {
        switch ($source) {
            case "post":
                return !empty($_POST);
            case "get":
                return !empty($_GET);
        }

        return false;
    }

}
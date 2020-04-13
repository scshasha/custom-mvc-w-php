<?php


namespace App\Model;

use Exception;
use App\Utility;

/**
 * Class UserLogin
 * @package App\Model
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class UserLogin
{
    /**
     * @var array
     */
    private static $_inputs = array(
      "email" => array(
          "filter" => "email",
          "required" => true,
      ),
      "password" => array(
          "required" => true,
      )
    );

    /**
     * Login: Validates login form inputs, checks if users exists, validate password provided
     * returning true when all goes well otherwise false
     * @access public
     * @return bool
     * @since 1.0
     * @throws Exception
     */
    public static function login()
    {
        // Validate.
        if (!Utility\Input::check($_POST, self::$_inputs)) {
            return false;
        }

        // Check if user exists.
        $email = Utility\Input::post("email");
        if (!$User = User::getInstance($email)) {
            Utility\Flash::info(Utility\Text::get("LOGIN_USER_NOT_FOUND"));
            return false;
        }

        try {
            $data = $User->data();
            $password = Utility\Input::post("password");
            if (Utility\Hash::generate($password, $data->salt) !== $data->password) {
                Utility\Flash::danger(Utility\Text::get("LOGIN_INVALID_ID_PASSWORD"));
                Utility\Redirect::to(APP_URL."login");
//                throw new Exception(Utility\Text::get("LOGIN_INVALID_ID_PASSWORD"));
            }

            // Remember me cookie.
            $remember = Utility\Input::post("remember") === "on";
            if ($remember && !self::createRememberCookie($data->id)) {
//                throw new Exception();
            }

            Utility\Session::put(Utility\Config::get("SESSION_USER"), $data->id);
            return true;
        } catch (Exception $exception) {
            Utility\Flash::warning($exception->getMessage());
        }
        return false;
    }

    /**
     * Logout: Removes cookie and session, returning true or false.
     * @access public
     * @return bool
     * @since 1.0
     */
    public static function logout()
    {

        Utility\Flash::info(Utility\Text::get("LOGOUT_USER_REQUEST_SUCCESS"));
        // Delete the users remember me cookie.
        $cookie = Utility\Config::get("COOKIE_USER");
        if (Utility\Cookie::exists($cookie)) {
            $Db = Utility\Database::getInstance();
            $hash = Utility\Cookie::get($cookie);
            $check = $Db->delete("user_cookies", array("hash", "=", $hash));

            if ($check->count()) {
                Utility\cookie::delete($cookie);
            }
        }

        Utility\Session::destroy();

        return true;
    }

    /**
     * Login With Cookie:
     * @access public
     * @return bool
     * @since 1.0
     */
    public static function loginWithCookie()
    {
        // Check if remember me cookie exists
        if (!Utility\Cookie::exists(Utility\Config::get("COOKIE_USER"))) {
            return false;
        }

        // Check if has is in Db, grabbing the users ID attaching it to the user if it does.
        $Db = Utility\Database::getnstance();
        $hash = Utility\Cookie::get(Utility\Config::get("COOKIE_USER"));
        $check = $Db->select("user_cookies", array("hash", "=", $hash));

        if ($check->count()) {

            // Does the user exist.
            $userID = $Db->first()->user_id;
            if (($User = User::getInstance($userID))) {
                $data = $User->data();
                Utility\Session::put(Utility\Config::get("SESSION_USER"), $data->id);
                return true;
            }
        }

        Utility\Cookie::delete(Utility\Config::get("COOKIE_USER"));
        return false;
    }

    /**
     * Create Remember Cookie:
     * @access public
     * @param string $userID
     * @return bool
     * @since 1.0
     */
    public static function createRememberCookie($userID)
    {
        $Db = Utility\Database::getInstance();
        $check = $Db->select("user_cookies", array("user_id", "=", $userID));
        if ($check->count()) {
            $hash = $check->first()->hash;
        } else {
            $hash = Utility\Hash::generateUnique();
            if (!$Db->insert("user_cookies", array("user_id" => $userID, "hash" => $hash))) {
                return false;
            }
        }

        $cookie = Utility\Config::get("COOKIE_USER");
        $expiry = Utility\Config::get("COOKIE_DEFAULT_EXPIRY");

        return Utility\Cookie::put($cookie, $hash, $expiry);
    }

}
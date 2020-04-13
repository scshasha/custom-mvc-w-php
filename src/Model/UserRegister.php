<?php


namespace App\Model;

use Exception;
use App\Utility;

/**
 * Class UserRegister
 * @package App\Model
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class UserRegister
{
    /**
     * @var array
     */
    private static $_inputs = array(
        "firstname" => array(
            "required" => true
        ),
        "lastname" => array(
            "required" => true
        ),
        "email" => array(
            "filter" => "email",
            "required" => true,
            "unique" => "users"
        ),
        "password" => array(
            "min_chars" => 6,
            "required" => true,
        ),
        "password_repeat" => array(
            "matches" => "password",
            "required" => true
        ),
    );

    /**
     * Register: Validates registration form inputs, creates/save the new user on the Db,
     * writes user data into a session
     * @access public
     * @return bool|string
     * @since 1.0
     */
    public static function register()
    {
//        echo "<pre>";
//        echo ":rules =><br>";
//        var_dump(self::$_inputs);
//        echo ":posted data =><br>";
//        var_dump($_POST);
//        die();
        // Validate registration form inputs.
        if (!Utility\Input::check($_POST, self::$_inputs)) {
            return false;
        }

        try {
            // Generate salt for password.
            $salt = Utility\Hash::generateSalt(32);

            // Insert new user to the Db, store the unique ID.
            $User = new User;
            $postData = array(
                "email" => Utility\Input::post("email"),
                "firstname" => Utility\Input::post("firstname"),
                "lastname" => Utility\Input::post("lastname"),
                "password" => Utility\Hash::generate(Utility\Input::post("password"), $salt),
                "salt" => $salt,
            );

            $userID = $User->createUser($postData);


            if (!$userID || $userID == "" || $userID == null) {
                Utility\Flash::danger(Utility\Text::get("REGISTER_USER_NOT_CREATED"));
            }

            // Store new user in a session.
            Utility\Flash::success(Utility\Text::get("REGISTER_USER_CREATED"));
            return $userID;
        } catch (Exception $exception) {
            Utility\Flash::danger($exception->getMessage());
        }

        return false;
    }

}
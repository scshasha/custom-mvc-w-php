<?php


namespace App\Model;

use Exception;
use App\Core;
use App\Utility;

/**
 * Class User
 * @package App\Model
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class User extends Core\Model
{
    /**
     * Create User: Inserts a single row into the Db.
     * @access public
     * @param array $fields
     * @return bool|string
     * @since 1.0
     * @throws Exception
     */
    public function createUser(array $fields)
    {
        if (!$userID = $this->create("users", $fields)) {
//            throw new Exception(Utility\Text::get("USER_CREATE_EXCEPTION"));
            Utility\Flash::danger(Utility\Text::get("USER_CREATE_EXCEPTION"));
            Utility\Redirect::to(APP_URL."register");
        }

        // Add user to roles
        $this->create("users" , ["USER", "{$userID}"]);
        return $userID;
    }

    /**
     * Update User: Updates a single user record.
     * @access public
     * @param array $fields
     * @param null $userID
     * @return void
     * @since 1.0
     * @throws Exception
     */
    public function updateUser(array $fields, $userID = null)
    {
        if (!$this->update("users", $fields, $userID)) {
            throw new Exception(Utility\Text::get("USER_UPDATE_EXCEPTION"));
        }
    }

    /**
     * Get Instance:
     * @param string $user
     * @return User|null
     * @since 1.0
     */
    public static function getInstance($user)
    {
        $User = new User();
        if ($User->findUser($user)->exists()) {
            return $User;
        }
        return null;
    }

    /**
     * Find User: Returns a single user.
     * @access public
     * @param string $user
     * @return Core\Model|bool
     * @since 1.0
     */
    public function findUser($user)
    {
        $field = filter_var($user, FILTER_VALIDATE_EMAIL) ? "email" : (is_numeric($user) ? "id" : "username");
        $User = $this->find("users", array($field, "=", $user) , array(
                "table" => "user_roles",
                "fields" => "user_role",
                "clause" => $user
            )
        );

//        var_dump($User);die();
        return $User;
    }

}
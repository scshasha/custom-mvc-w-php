<?php


namespace App\Utility;

/**
 * Class Token.
 *
 * @package App\Utility
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Token
{
    /**
     * Check: Returns true/false depending if given $token matches the one stored in session.
     *
     * @access public
     *
     * @param $token
     *
     * @return bool
     * @since 1.0
     */
    public static function check($token)
    {
        return $token === Session::get(Config::get("SESSION_TOKEN"));
    }

    /**
     * Generate: Returns CSRF token, generating a new one if expired.
     *
     * @access public
     * @return mixed
     * @since 1.0
     */
    public static function generate()
    {
        $maxTime = 60*60*24;
        $tokenSession = Config::get("SESSION_TOKEN");
        $token = Session::get($tokenSession);
        $tokenSessionTime = Config::get("SESSION_TOKEN_TIME");
        $tokenTime = Session::get($tokenSessionTime);
        if ($maxTime + $tokenTime <= time() || empty($token)) {
            Session::put(Config::get("SESSION_TOKEN"), md5(uniqid(rand(), true)));
            Session::put($tokenSessionTime, time());
        }
        return Session::get($tokenSession);
    }

}
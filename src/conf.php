<?php

return array(
    /**
     * Database Config
     *
     * @TODO:
     *
     * Implement functionality to read database settings from a .env file or similar.
     *
     * ================================================================================================================
     */
    "DATABASE_HOST" => 'localhost',
    "DATABASE_NAME" => 'playsiz',
    "DATABASE_USERNAME" => "root",
    "DATABASE_PASSWORD" => "",

    /**
     * Cookie Config
     * ================================================================================================================
     */
    "COOKIE_DEFAULT_EXPIRY" => 604800,
    "COOKIE_USER" => "user",
    "" => "",

    /**
     * Session Config
     * ================================================================================================================
     */
    "SESSION_USER" => "user",
    "SESSION_TOKEN" => "token",
    "SESSION_TOKEN_TIME" => "token_time",
    "SESSION_ERRORS" => "errors",
    "SESSION_FLASH_WARNING" => "warning",
    "SESSION_FLASH_DANGER" => "danger",
    "SESSION_FLASH_INFO" => "info",
    "SESSION_FLASH_SUCCESS" => "success",
    "" => "",

    /**
     * Tests Config
     * ================================================================================================================
     */
    "TEXTS" => array(
        /**
         * Login texts
         * ==============================================================================================================
         */
        "LOGIN_INVALID_ID_PASSWORD" => "The email / password you have entered is incorrect.",
        "LOGIN_USER_NOT_FOUND" => "The email you have entered has not been found!",
        "" => "",

        /**
         * Login texts
         * ==============================================================================================================
         */
        
        "LOGOUT_USER_REQUEST_SUCCESS" => "You have been logged out successfully!",
        "LOGIN_REQUIRED_EXCEPTION" => "Login required! Please use the form below.",
        "" => "", 

        /**
         * Register texts
         * ==============================================================================================================
         */
        "REGISTER_USER_CREATED" => "Your account has been successfully created!",
        "REGISTER_USER_NOT_CREATED" => "Your account was not created! Please try again later or contact us.",
        "" => "",

        /**
         * User texts
         * ==============================================================================================================
         */
        "USER_CREATE_EXCEPTION" => "There was a problem creating this account!",
        "USER_UPDATE_EXCEPTION" => "There was a problem updating this account!",
        "USER_ACCESS_DENIED" => "Access denied!",
        "" => "",

        /**
         * Input Utility texts
         * ==============================================================================================================
         */
        "INPUT_INCORRECT_CSRF_TOKEN" => "CSRF verification failed!",
        "" => "",

        /**
         * Validate Utility texts
         * ==============================================================================================================
         */
        "VALIDATE_FILTER_RULE" => "%ITEM% is not a valid %RULE_VALUE%!",
        "VALIDATE_MISSING_INPUT" => "Unable to validate %ITEM%!",
        "VALIDATE_MISSING_METHOD" => "Unable to validate %ITEM%!",
        "VALIDATE_MATCHES_RULE" => "%RULE_VALUE% must match %ITEM%!",
        "VALIDATE_MIN_CHARACTERS_RULE" => "%ITEM% must be a minimum of %RULE_VALUE% characters.",
        "VALIDATE_MAX_CHARACTERS_RULE" => "%ITEM% can only be a maximum of %RULE_VALUE% characters.",
        "VALIDATE_REQUIRED_RULE" => "%ITEM% is required!",
        "VALIDATE_UNIQUE_RULE" => "%ITEM% already exists.",
        "" => "",


        /**
         * @TODO: Add more text configs here.
         * ==============================================================================================================
         */
        "" => "",

    ),

    /**
     * @TODO: Think of other things that could go here.
     * ================================================================================================================
     */
    "" => "",

);
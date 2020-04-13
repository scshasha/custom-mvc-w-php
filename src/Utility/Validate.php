<?php


namespace App\Utility;

/**
 * Class Validate
 *
 * @package App\Utility
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Validate
{
    /**
     * @var null
     */
    private $_Db = null;
    /**
     * @var null
     */
    private $_rowID = null;
    /**
     * @var bool
     */
    private $_passed = false;
    /**
     * @var array
     */
    private $_source = array();
    /**
     * @var array
     */
    private $_errors = array();

    /**
     * Validate constructor.
     *
     * @access public
     * @param array $source
     * @param       $rowID
     *
     * @since 1.0
     */
    public function __construct(array $source, $rowID = null)
    {
        $this->_Db = Database::getInstance();
        $this->_rowID = $rowID;
        $this->_source = $source;
    }

    /**
     * Passed
     *
     * @access public
     * @return bool
     * @since  1.0
     */
    public function passed()
    {
        return $this->_passed;
    }

    /**
     * Errors
     * @access public
     * @return array
     * @since 1.0
     */
    public function errors()
    {
        return $this->_errors;
    }

    /**
     * Add Error
     * @access private
     *
     * @param $input
     * @param $error
     *
     * @return void
     * @since 1.0
     */
    private function _addError($input, $error)
    {
        $this->_errors[$input][] = str_replace(array('-','_'), ' ', ucfirst(strtolower($error)));
    }
    /**
     * Check:
     *
     * @access public
     * @param array $inputs
     *
     * @return $this
     * @since 1.0
     */
    public function check(array $inputs)
    {
        $this->_errors = array();
        $this->_passed = false;

//        var_dump($inputs);die();
        foreach ($inputs as $index => $value) {
            if (isset($this->_source[$index])) {
                $val = trim($this->_source[$index]);
                $this->_validate($index, $val, $value);
            } else {
                $this->_addError($index, Text::get("VALIDATE_MISSING_INPUT", array("%ITEM%" => $index)));
            }
        }
        if (empty($this->_errors)) {
            $this->_passed = true;
        }

        return $this;
    }

    /**
     * Validate
     *
     * @access private
     *
     * @param       $input
     * @param       $value
     * @param array $rules
     *
     * @return void
     * @since 1.0
     */
    private function _validate($input, $value, array $rules)
    {
        foreach ($rules as $rule => $ruleValue) {
            if (empty($value) && ($rule === "required" && $ruleValue === true)) {
                $this->_addError($input, Text::get("VALIDATE_REQUIRED_RULE", array("%ITEM%" => $input)));
            } elseif(!empty($value)) {
                $method = lcfirst(ucwords(strtolower(str_replace(array("=", "_", "", $rule))))) . "Rule";
                if (method_exists($this, $method)) {
                    $this->{$method}($input, $value, $ruleValue);
                } else {
                    $this->_addError($input, Text::get("VALIDATE_MISSING_METHOD", array("%ITEM%" => $input)));
                }
            }
        }
    }

    /**
     * Filter Rule.
     * @access protected
     *
     * @param $input
     * @param $value
     * @param $ruleValue
     *
     * @return void
     * @since 1.0
     */
    protected function filterRule($input, $value, $ruleValue)
    {
        switch ($ruleValue) {
            /**
             * @TODO:
             * Add more cases based on form field requirements. Also view the Input class
             */
            case "email":
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $data = array(
                        "%ITEM%" => $input,
                        "%RULE_VALUE%" => $ruleValue,
                    );
                    $this->_addError($input, Text::get("VALIDATE_FILTER_RULE", array("%ITEM%" => $input)));

//                    $this->_addError($input, Text::get("VALIDATE_FILTER_RULE", $data));
                }
                break;
        }
    }

    /**
     * Max Char. Rule.
     * @access protected
     *
     * @param $input
     * @param $value
     * @param $ruleValue
     *
     * @return void
     * @since 1.0
     */
    protected function maxCharactersRule($input, $value, $ruleValue)
    {
        if (strlen($value) > $ruleValue) {
            $data = array(
                "%ITEM%" => $input,
                "%RULE_VALUE%" => $ruleValue,
            );
//            $this->_addError($input, Text::get("VALIDATE_MAX_CHARACTERS_RULE", $data));
            $this->_addError($input, Text::get("VALIDATE_MAX_CHARACTERS_RULE", array("%ITEM%" => $input)));

        }
    }

    /**
     * Min Char. Rule.
     * @access protected
     *
     * @param $input
     * @param $value
     * @param $ruleValue
     *
     * @return void
     * @since 1.0
     */
    protected function minCharactersRule($input, $value, $ruleValue)
    {
        if(strlen($value) < $ruleValue) {
            $data = array(
                "%ITEM%" => $input,
                "%RULE_VALUE%" => $ruleValue,
            );
            $this->_addError($input, Text::get("VALIDATE_MIN_CHARACTERS_RULE", array("%ITEM%" => $input)));
//            $this->_addError($input, Text::get("VALIDATE_MIN_CHARACTERS_RULE", $data));
        }
    }
    /**
     * Matches Rule.
     * @access protected
     *
     * @param $input
     * @param $value
     * @param $ruleValue
     *
     * @return void
     * @since 1.0
     */
    protected function matchesRule($input, $value, $ruleValue)
    {
        if($value != $this->_source[$ruleValue]) {
            $data = array(
                "%ITEM%" => $input,
                "%RULE_VALUE%" => $ruleValue,
            );
            $this->_addError($input, Text::get("VALIDATE_MATCHES_RULE", array("%ITEM%" => $input)));

//            $this->_addError($input, Text::get("VALIDATE_MATCHES_RULE", $data));
        }
    }

    /**
     * Required Rule.
     * @access protected
     *
     * @param $input
     * @param $value
     * @param $ruleValue
     *
     * @return void
     * @since 1.0
     */
    protected function requiredRule($input, $value, $ruleValue)
    {
        if(empty($value) && $ruleValue === true) {
            $this->_addError($input, Text::get("VALIDATE_REQUIRED_RULE", array("%ITEM%" => $input)));

        }
    }

    /**
     * Unique Rule.
     * @access protected
     *
     * @param $input
     * @param $value
     * @param $ruleValue
     *
     * @return void
     * @since 1.0
     */
    protected function uniqueRule($input, $value, $ruleValue)
    {
        $check = $this->_Db->select($ruleValue, array($input, "=", $value));
        if ($check->count()) {
            if ($this->_rowID && $check->first()->id === $this->_rowID) {
                return;
            }
            $this->_addError($input, Text::get("VALIDATE_UNIQUE_RULE", array("%ITEM%" => $input)));
        }
    }





}
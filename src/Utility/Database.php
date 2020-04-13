<?php


namespace App\Utility;

use PDO;
use PDOException;

/**
 * Class Database
 *
 * @package App\Utility
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Database
{
    private static $_Database;
    /**
     * @var null
     */
    private $_PDO = null;
    /**
     * @var null
     */
    private $_query = null;
    /**
     * @var bool
     */
    private $_error = false;
    /**
     * @var array
     */
    private $_results = array();
    /**
     * @var int
     */
    private $_count = 0;

    /**
     * Database constructor.
     *
     * @access  private
     * @since   1.0
     */
    private function __construct()
    {
        try {
            $DbHost = Config::get("DATABASE_HOST");
            $DbName = Config::get("DATABASE_NAME");
            $DbUsername = Config::get("DATABASE_USERNAME");
            $DbPassword = Config::get("DATABASE_PASSWORD");
            $this->_PDO = new PDO(
              sprintf("mysql:host=%s;dbname=%s", $DbHost, $DbName),
              $DbUsername, $DbPassword
            );
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * @access public
     * @return \App\Utility\Database
     * @since   1.0
     */
    public static function getInstance()
    {
        if (!isset(self::$_Database)) {
            self::$_Database = new Database();
        }

        return self::$_Database;
    }


    /**
     * Action:
     *
     * @access public
     *
     * @param string $action
     * @param string $table
     * @param array  $where [optional]
     *
     * @return $this|bool
     *
     * @since 1.0
     */
    public function action(string $action, string $table, array $where = [], $join = [])
    {

        if (count($join) === 3) {
            $operator = $where[1];
            $operators = array("=", "<", ">", "<=", "=>", "LIKE");

            if (in_array($operator, $operators)) {
                $field = $where[0];
                $value = $where[2];
                $params = array(":value" => $value);
                if (!$this->query("{$action} FROM `{$table}` as A LEFT JOIN `{$join['table']}` as B ON A.id = B.user_id WHERE A.`{$field}` {$operator} :value", $params)->error()) {
                    return $this;
                }
            }
        }
        if (count($where) === 3) {
            $operator = $where[1];
            $operators = array("=", "<", ">", "<=", "=>", "LIKE");

            if (in_array($operator, $operators)) {
                $field = $where[0];
                $value = $where[2];
                $params = array(":value" => $value);
                if (!$this->query("{$action} FROM `{$table}` WHERE `{$field}` {$operator} :value", $params)->error()) {
                    return $this;
                }
            }
        } else {
            if (!$this->query("{$action} FROM `{$table}`")->error()) {
                return $this;
            }
        }

        return false;
    }

    /**
     * Insert:
     *
     * @access pubic
     *
     * @param string $table
     * @param array  $fields
     *
     * @return bool|string
     * @since 1.0
     */
    public function insert(string $table, array $fields)
    {
        if (count($fields)) {
            $params = array();
            foreach($fields as $index => $value) {
                $params[":{$index}"] = $value;
            }
            $columns = implode("`, `", array_keys($fields));
            $values = implode(", ", array_keys($params));

            if (!$this->query("INSERT INTO `{$table}` (`{$columns}`) VALUES({$values})", $params)->error()) {
                return $this->_PDO->lastInsertId();
            }
        }

        return false;
    }

    /**
     * Select:
     *
     * @access public
     *
     * @param string $table
     * @param array  $where [optional]
     *
     * @return $this|bool
     * @since 1.0
     */
    public function select(string $table, array $where = [], $join = null)
    {
        if (!$join) {
//            die("inside");
            return $this->action("SELECT *", $table, $where);
        }
//        die("outside");


        return $this->action("SELECT A.*, B.user_role", $table, $where, $join);
    }

    public function join(string $table, array $where = [], array $params = [])
    {

        // DO SOMETHING FUN HERE

    }

    /**
     * @param string                  $table
     * @param string $id
     * @param array                   $fields
     *
     * @return bool
     */
    public function update(string $table, string $id, array $fields)
    {
        if (count($fields)) {
            $i = 1;
            $set = "";
            $params = array();
            foreach($fields as $index => $value) {
                $params[":{$index}"] = $value;
                $set .= sprintf("`%s`= :%s", $index, $index);
                if ($i < count($fields)) {
                    $set .= ", ";
                }
                $i++;
            }

            if (!$this->query("UPDATE `{$table}` SET {$set} WHERE `id` = {$id}", $params)->error()) {
                return true;
            }
        }
        return false;
    }


    /**
     * Delete:
     *
     * @access public
     *
     * @param string $table
     * @param array  $where
     *
     * @return $this|bool
     * @since 1.0
     */
    public function delete(string $table, array $where = [])
    {
        return $this->action("DELETE", $table, $where);
    }

    /**
     * Count:
     *
     * @access public
     * @return int
     * @since 1.0
     */
    public function count()
    {
        return $this->_count;
    }

    /**
     * @access public
     * @return mixed
     * @since 1.0
     */
    public function first()
    {
        return $this->results(0);
    }

    /**
     * Error
     * @return bool
     * @since 1.0
     */
    public function error()
    {
        return $this->_error;
    }

    /**
     * Results:
     *
     * @access public
     *
     * @param int|null $key
     *
     * @return array|mixed
     * @since 1.0
     */
    public function results(int $key = null)
    {
        return isset($key) ? $this->_results[$key] : $this->_results;
    }

    /**
     * Query:
     *
     * @access public
     *
     * @param string $sql
     * @param array  $params [optional]
     *
     * @return \App\Utility\Database
     * @since 1.0
     */
    public function query(string $sql, array $params = [])
    {
        $this->_count = 0;
        $this->_error = false;
        $this->_results = array();

        if ($this->_query = $this->_PDO->prepare($sql)) {
            foreach($params as $index => $value) {
                $this->_query->bindValue($index, $value);
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }




}
<?php

namespace App\Core;


use App\Utility;

/**
 * Class Model
 * @package App\Core
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Model
{
    /**
     * @var |null 
     */
    protected $Db = null;
    /**
     * @var array
     */
    protected $data  = [];

    /**
     * Model constructor.
     * @access public
     * @since 1.0
     */
    public function __construct()
    {
        $this->Db = Utility\Database::getInstance();
    }

    /**
     * Data: Returns a record from the Db.
     *
     * @access public
     * @return array
     * @since 1.0
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * Is Admin: Check if user role is admin, returns true, otherwise false.
     *
     * @access public
     * @return bool
     * @since 1.0
     */
    public function isAdmin()
    {
        return ((string) strtoupper($this->data->user_role) === "ADMIN") ? true : false;
    }


    /**
     * Exists: Returns true/false if record has been pulled from the Db.
     * @ccess public
     * @return bool
     * @since 1.0
     */
    public function exists()
    {
        return !empty($this->data);
    }

    /**
     * Create: Inserts a new record into the Db. Returning a unique record ID if successful.
     * @access protected
     * @param string $table
     * @param array $fields
     * @return string|bool
     * @since 1.0
     * @throws Exception
     */
    protected function create($table, array $fields)
    {
        return $this->Db->insert($table, $fields);
    }

    /**
     * Update: Updates a row record in the Db.
     *
     * @access protected
     *
     * @param string $table
     * @param array  $fields
     * @param null   $rowID
     *
     * @return bool
     * @since  1.0
     */
    protected function update($table, array $fields, $rowID = null)
    {
        if (!$rowID && $this->exists()) {
            $rowID = $this->data()->id();
        }
        return $this->Db->update($table, $fields);
    }

    /**
     * Find: Retrieves and store record from the Db into a class property.
     *
     * @access protected
     *
     * @param string $table
     * @param array $where
     *
     * @return \App\Core\Model
     * @since 1.0
     */
    protected function find($table, array $where = array(), $join = array())
    {
        $data = $this->Db->select($table, $where, $join);
//        echo "<pre>";
//        var_dump($data);
//        die();


        if ($data->count()) {
            $this->data = $data->first();
        }

        return $this;
    }

    /**
     * Delete: Removes a record from the Db.
     *
     * @access protected
     * @param string $table
     * @param array  $where
     *
     * @return \App\Utility\Database|bool
     * @since 1.0
     */
    protected function _delete(string $table, array $where = array())
    {
        return $data = $this->Db->delete($table, $where);
    }

}
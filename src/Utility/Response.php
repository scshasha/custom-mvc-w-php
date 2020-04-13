<?php


namespace App\Utility;

/**
 * Class Response.
 *
 * @package App\Utility
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class Response
{
    /**
     * @var array
     */
    private $_data = array();

    /**
     * Success:
     *
     * @access public
     *
     * @param array $data
     *
     * @return void
     * @since 1.0
     */
    public function success($data = [])
    {
        $Response = new Response();
        $Response->setSuccess();
        $Response->setData($data);
        $Response->setStatusCode(200);
        $Response->outputJSON();
    }
    /**
     * Error:
     *
     * @access public
     *
     * @param       $status
     * @param array $data
     *
     * @return void
     * @since 1.0
     */
    public function error($status, $data = [])
    {
        $Response = new Response();
        $Response->setError();
        $Response->setData($data);
        $Response->setStatusCode($status);
        $Response->outputJSON();
    }

    /**
     * Set Data
     *
     * @access public
     *
     * @param $data
     *
     * @return App\Utility\Response
     * @since 1.0
     */
    public function setData($data)
    {
        if (!is_array($data)) {
            $data = (array) $data;
        }
        $this->_data = array_merge($this->_data, $data);

        return $this;
    }

    /**
     * Set Success
     *
     * @access public
     * @return \App\Utility\Response
     * @since  1.0
     */
    public function setSuccess()
    {
        $this->_data['success'] = true;return $this;
    }

    /**
     * Set Error
     *
     * @access public
     * @return \App\Utility\Response
     * @since  1.0
     */
    public function setError()
    {
        $this->_data['success'] = false;return $this;
    }

    /**
     * Set Status Code
     *
     * @access public
     *
     * @param integer   $status
     *
     * @return App\Utility\Response
     * @since 1.0
     */
    public function setStatusCode($status)
    {
        $statuses = array(
            500 => "Internal Server Error",
            405 => "Method Not Allowed",
            404 => "Not Found",
            403 => "Forbidden",
            401 => "Unauthorized",
            400 => "Bad Request",
            200 => "OK",
        );

        if (array_key_exists($status, $statuses)) {
            header("HTTP/1.1 {$status}" . $statuses[$status]);
        }

        return $this;
    }

    /**
     * Output Json
     *
     * @access public
     * @return void
     * @since 1.0
     */
    public function outputJSON()
    {
        header("Access-Control-Allow-Origin: *"); // Access-Control-Allow-Orgin
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
        die(json_encode($this->_data));
    }
}
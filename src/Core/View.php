<?php


namespace App\Core;

/**
 * Class View
 * @package App\Core
 *
 * @author Chris Shasha <scshasha@icloud.com>
 * @since 1.0
 */
class View
{
    /**
     * @var string
     */
    protected $title = "";
    /**
     * @var string
     */
    private $_linkTags = "";
    /**
     * @var string
     */
    private $_scriptTags = "";

    /**
     * Add Data:
     * @access public
     * @param array $data
     * @return void
     * @since 1.0
     */
    public function addData($data)
    {
        foreach($data as $index => $value) {
            $this->{$index} = $value;
        }

    }

    /**
     * Add JS:
     * @access public
     * @param mixed $files
     * @return void
     * @since 1.0
     */
    public function addJS($files)
    {
        if (!is_array($files)) {
            $files = (array) $files;
        }
        foreach($files as $file) {
            if (file_exists(PUBLIC_ROOT.$file)) {
                $this->_scriptTags .= sprintf('<script type="text/javascript" src="%s"></script>\n', $this->makeURL($file));
            }
        }

    }


    /**
     * Add CSS:
     * @access public
     * @param mixed $files
     * @return void
     * @since 1.0
     */
    public function addCSS($files)
    {
        if (!is_array($files)) {
            $files = (array) $files;
        }
        foreach($files as $file) {
            if (file_exists(PUBLIC_ROOT.$file)) {
                $this->_linkTags .= sprintf('<link rel="stylesheet" href="%s" />\n', $this->makeURL($file));
            }
        }
    }

    /**
     * Escape HTML:
     * @access public
     * @param $string
     * @return string
     * @since 1.0
     */
    public function escapeHTML($string)
    {
        return htmlentities($string, HTMLENTITIES_FLAGS, HTMLENTITIES_ENCODING, HTMLENTITIES_DOUBLE_ENCODE);
    }

    /**
     * Render:
     * @access public
     * @param string $filepath
     * @param array $data [optional]
     * @return void
     * @since 1.0
     */
    public function render($filepath, array $data = [])
    {

        $this->addData($data);
        $this->getFile(DEFAULT_HEADER_PATH);
        $this->getFile($filepath);
        $this->getFile(DEFAULT_FOOTER_PATH);

    }

    /**
     * Render Multiple:
     * @access public
     * @param array $filepaths
     * @param array $data [optional]
     * @return void
     * @since 1.0
     */
    public function renderMultiple(array $filepaths, array $data = [])
    {
        $this->addData($data);
        $this->getFile(DEFAULT_HEADER_PATH);
        foreach($filepaths as $filepath) {
            $this->getFile($filepath);
        }
        $this->getFile(DEFAULT_FOOTER_PATH);
    }

    /**
     * Render Without Header and Footer:
     * @access public
     * @param string $filepath
     * @param array $data [optional]
     * @return void
     * @since 1.0
     */
    public function renderWithoutHeaderAndFooter($filepath, array $data = [])
    {
        $this->addData($data);
        $this->getFile($filepath);
    }

    /**
     * Make URL:
     * @access public
     * @param mixed $path [optiona]
     * @return string
     * @since 1.0
     */
    public function makeURL($path = "")
    {
        if (is_array($path)) {
            return APP_URL.implode("/",$path);
        }
        return APP_URL.$path;
    }

    /**
     * Get CSS:
     * @access public
     * @return string
     */
    public function getCSS()
    {
        return $this->_linkTags;
    }

    /**
     * GET JS:
     * @access public
     * @return string
     */
    public function getJS()
    {
        return $this->_scriptTags;
    }

    /**
     * Get File:
     * @access public
     * @param $filepath
     * @return void
     * @since 1.0
     */
    public function getFile($filepath)
    {
        $filename = sprintf("%s.php", VIEW_PATH.$filepath);

        if (file_exists($filename)) {
            require $filename;
        } else {
            var_dump((APP_ROOT.VIEW_PATH.$filepath));
            echo "<br>";
            echo "<br>";
            echo "<br>";
            die("Could not find {$filename}");
        }
    }


}
<?php

require_once "../vendor/autoload.php";

// Configuration
define("ROOT", realpath(dirname(__FILE__) . "/../") . "/");

// Application Conf
define("APP_NAME", "DREAMSHARE");
define("APP_PROTOCOL", strpos($_SERVER["SERVER_PROTOCOL"], "https") === true ? "https://" : "http://");
define("APP_URL", APP_PROTOCOL . $_SERVER["HTTP_HOST"] . str_replace("public", "", dirname($_SERVER['SCRIPT_NAME'])) . ""); // @todo: Append "/" if you get issues
define("APP_ROOT", ROOT . "src/");
define("APP_CONFIG_FILE", ROOT . "src/conf.php");

// Public Conf
define("PUBLIC_ROOT", ROOT . "public/");

// Controller Conf
define("CONTROLLER_PATH", "\App\Controller\\");
define("DEFAULT_CONTROLLER", CONTROLLER_PATH . "Index");
define("DEFAULT_CONTROLLER_ACTION", "Index");

// Presenter Conf
define("DEFAULT_PRESENTER", "format");

// View Config
define("VIEW_PATH", APP_ROOT . "View/"); // @TODO use ../src/View if this fails.
define("DEFAULT_404_PATH", "_tmpl/404.php");
define("DEFAULT_HEADER_PATH", "_tmpl/header");
define("DEFAULT_FOOTER_PATH", "_tmpl/footer");
define("HTMLENTITIES_FLAGS", ENT_QUOTES);
define("HTMLENTITIES_ENCODING", "UTF-8");
define("HTMLENTITIES_DOUBLE_ENCODE", false);


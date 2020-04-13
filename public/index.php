<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: *');
// header('Access-Control-Allow-Headers: *');
// header('Access-Control-Allow-Credentials: true');

require_once "../src/init.php";

//var_dump(DEFAULT_CONTROLLER,DEFAULT_CONTROLLER_ACTION);die();
$App = new App\Core\App;
$App->run();

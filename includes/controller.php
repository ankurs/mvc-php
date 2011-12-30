<?php
// get app config
require_once("../config.php");

require_once(APP_PATH."/includes/Controllers.class.php");
require_once(APP_PATH."/Smarty/Smarty.class.php");

$con = new Controllers();
$con->route();

?>

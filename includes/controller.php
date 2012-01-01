<?php
// get app config
require_once("../config.php");

require_once(APP_PATH."/includes/Controllers.class.php");
require_once(SMARTY_PATH."/Smarty.class.php");

$con = new Controllers();
$con->route();

?>

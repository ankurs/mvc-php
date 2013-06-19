<?php
// get app config
require_once(APP_PATH."/config.php");

$con = new Controllers();
$con->route();

?>

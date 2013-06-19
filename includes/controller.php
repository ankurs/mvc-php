<?php
// get app config
require_once(MVC_APP_PATH."/config.php");

$con = new Controllers();
$con->route();

?>

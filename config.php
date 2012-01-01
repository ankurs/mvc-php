<?php

// base path of your mvc-php application
define('APP_PATH','/var/www/html/mvc-php/');
// base path of Smarty
define('SMARTY_PATH', '/usr/share/php/Smarty/'); // on Fedora 16

// debug levels
define('DEBUG_MAIN', 1);
define('DEBUG_VERBOSE', 2);

define('DEBUG_LOG', 'log');
define('DEBUG_HTML', 'html');


//control debug
define('DEBUG_ENABLED',true);
define('DEBUG_LEVEL', DEBUG_MAIN);
define('DEBUG_FUNCTION', DEBUG_LOG); 

require_once(APP_PATH."/includes/helper.php");

?>

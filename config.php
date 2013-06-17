<?php

require_once("includes/helper.php");

if (defined('MVC_OVERRIDE_CONFIG_FILE') && MVC_OVERRIDE_CONFIG_FILE)
{
    require_once(MVC_OVERRIDE_CONFIG_FILE);
}

// base path of your mvc-php application
addDefine('APP_PATH','/var/www/html/mvc-php/');
// base path of Smarty
addDefine('SMARTY_PATH', '/usr/share/php/Smarty/'); // on Fedora 16

// debug levels
addDefine('DEBUG_MAIN', 1);
addDefine('DEBUG_VERBOSE', 2);

addDefine('DEBUG_LOG', 'log');
addDefine('DEBUG_HTML', 'html');

//control debug
addDefine('DEBUG_ENABLED',true);
addDefine('DEBUG_LEVEL', DEBUG_MAIN);
addDefine('DEBUG_FUNCTION', DEBUG_LOG); 

?>

<?php
class Controllers
{
    public static function getControllerName ($controller)
    {
        $controllerfiles = explode("/",$controller);
        $parts = explode("_",$controllerfiles[count($controllerfiles) -1]);
        $controller = "";

        foreach ($parts as $part)
        {
            $controller .= ucfirst($part);
        }

        return $controller;
    }

    public static function clean($string)
    {
        return preg_replace("/[^A-Z0-9a-z]*/","",strval($string));
    }

    public static function route()
    {
        if (strval($_REQUEST['_controller']) == null || strval($_REQUEST['_controller']) =='' )
        {
            $controller = "indexController";
        }
        else
        {
            $controller = strval($_REQUEST['_controller'])."Controller";
        }
        $controler = Controllers::clean($controller);

        $controllerPath = Controllers::getControllerName($controller);
        echo "Controller is -> ".$controllerPath."<br/>";
        echo "Request for-> ".$_SERVER['REQUEST_URI']."<br/>";

        $controllerFullPath=APP_PATH."/includes/controllers/".$controllerPath.".php";
        echo "looking for $controllerFullPath <br/>";

        if (file_exists($controllerFullPath))
        {
            require_once($controllerFullPath);
            echo "required $controllerFullPath <br/>";
            $handler = new $controllerPath();
            $action = Controllers::clean($_REQUEST['_action']);
            if ($action)
            {
                $action .="Action";
            }
            else
            {
                $action = "defaultAction";
            }

            if (is_callable(array($controllerPath, $action)))
            {
                $handler->$action();
            }
            else
            {
                echo "<br>cannot find $action<br/>";
                $handler->defaultAction();
            }

        }
        else
        {
            echo "<h1>Controller file $controllerPath NOT FOUND</h1>";
        }
    }
}
?>

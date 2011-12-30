<?php
require_once(APP_PATH."/includes/controllers/ErrorController.php");
class Controllers
{
    public $controllerName;

    public function clean($string, $startCaps = false)
    {
        $string = preg_replace("/[^A-Z0-9a-z\/]*/", "", strval($string));
        $parts = explode("/",$string);
        $string = "";
        
        foreach ($parts as $part)
        {
            if (!$startCaps)
            {
                $string .= $part;
                $startCaps = true;
            }
            else
            {
                $string .= ucfirst($part);
            }
        }
        return $string;
    }

    public function getParams()
    {
        echo "<br/> trying to get params";
        $params = array();
        if(isset($_REQUEST['_params']))
        {
            $string = strval($_REQUEST['_params']);
            echo "<br/> params is $string";
            $parts = explode("/",$string);
            foreach($parts as $part)
            {
                if ($part=='')
                    continue;
                $params[] = $part;
            }
        }
        return $params;
    }

    public function getAction()
    {
        if (isset($_REQUEST['_action']))
        {
            return $this->clean($_REQUEST['_action'])."Action";
        }
        else
        {
            return "defaultAction";
        }
    }

    public function getController()
    {
        if (strval($_REQUEST['_controller']) == null || strval($_REQUEST['_controller']) =='' )
        {
            $controller = "IndexController";
        }
        else
        {
            $controller = strval($_REQUEST['_controller'])."Controller";
        }
        $controller = $this->clean($controller, true);

        echo "Controller is -> ".$controller."<br/>";
        echo "Request for-> ".$_SERVER['REQUEST_URI']."<br/>";

        $controllerFullPath=APP_PATH."/includes/controllers/".$controller.".php";
        echo "looking for $controllerFullPath <br/>";

        if (file_exists($controllerFullPath))
        {
            require_once($controllerFullPath);
            echo "required $controllerFullPath <br/>";
            $handler = new $controller();
            $this->controllerName = $controller;
            return $handler;
        }
        else
        {
            return null;
        }

    }

    public function route()
    {
        $handler = $this->getController();
        if ($handler)
        {
            $action = $this->getAction();
            echo "<br> Action is -> $action</br>";            

            $params = $this->getParams();
            
            try{
                if (is_callable(array($this->controllerName, $action)))
                {
                    echo "<br> Calling -> $action</br>";
                    $handler->$action($params);
                }
                else
                {
                    echo "<br>cannot find $action<br/>";
                    $handler->defaultAction($params);
                }
            }
            catch(Exception $exp)
            {
                $handler = new ErrorController();
                $handler->defaultAction();
                echo "<br/>got Exception ".print_r($exp,true);
            }
        }
        else
        {
            $handler = new ErrorController();
            $handler->NotFoundAction();
        }
    }

}
?>

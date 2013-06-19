<?php

require_once(MVC_CONTROLLER_PATH."/ErrorController.php");

class Controllers
{
    public $controllerName;

    public function clean($string, $startCaps = false)
    {
        debug("starting clean on ".strval($string));        
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
        debug("cleaned string is ".$string);
        return $string;
    }

    public function getParams()
    {
        debug("trying to get params");
        $params = array();
        if(isset($_REQUEST['_params']))
        {
            $string = strval($_REQUEST['_params']);
            $parts = explode("/",$string);
            foreach($parts as $part)
            {
                if ($part=='')
                    continue;
                $params[] = $part;
            }
        }
        debug("params is".print_r($params,true));
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

        debug('Controller is -> '.$controller);
        debug('Request for-> '.$_SERVER['REQUEST_URI']);

        $controllerFullPath=MVC_CONTROLLER_PATH.$controller.'.php';
        debug('looking for '.$controllerFullPath);

        if (file_exists($controllerFullPath))
        {
            include_once($controllerFullPath);
            debug('required '.$controllerFullPath);
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
        $action = $this->getAction();
        debug('Action is -> '.$action);

        $params = $this->getParams();
        debug('got params -> '.print_r($params,true));

        try{
            $handler = $this->getController();
            if ($handler)
            {
                if (is_callable(array($this->controllerName, $action)))
                {
                    debug('executing action -> '.$action);
                    $handler->$action($params);
                }
                else
                {
                    debug('cannot find action -> '.$action);
                    $handler->defaultAction($params);
                }
            }
            else
            {
                $handler = new ErrorController();
                $handler->notFoundAction(array("action" => $action, "params" => $params));
            }
        }
        catch(Exception $exp)
        {
            $handler = new ErrorController();
            $handler->defaultAction($params);
            debug('got Exception while executing action -> '.$action.' error -> '.print_r($exp,true));
        }
    }

}
?>

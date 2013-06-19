<?php

class ErrorController
{
    public function defaultAction($params)
    {
        echo "<br/><h1>Error Occured: on url -> ".$_SERVER['REQUEST_URI']." </h1>";
        error_log('Error Occured: on url -> '.$_SERVER['REQUEST_URI']);
    }

    public function notFoundAction($params)
    {
        echo "<br/><h1>Error Occured: NOT FOUND -> ".$_SERVER['REQUEST_URI']." on Server</h1>".print_r($params,true);
        error_log('Error Occured: NOT FOUND -> '.$_SERVER['REQUEST_URI'].' on Server \n'.print_r($params,true));
    }
}

?>

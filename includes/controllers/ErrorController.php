<?php

class ErrorController
{
    public function defaultAction($param)
    {
        echo "<br/><h1>Error Occured: on url -> ".$_SERVER['REQUEST_URI']." </h1>";
    }

    public function NotFoundAction($param)
    {
        echo "<br/><h1>Error Occured: NOT FOUND -> ".$_SERVER['REQUEST_URI']." on Server</h1>";
    }
}

?>

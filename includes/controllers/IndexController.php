<?php

class IndexController
{
    protected $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
    }

    public function abcAction()
    {
        echo "<h1> Hi from indexController - abcAction</h1>";
    }

    public function defaultAction()
    {
        echo "<h1> Hi from indexController - defaultAction</h1>";
    }
}

echo "<br/>controller finished</br>";

?>

<?php

class IndexController
{
    protected $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
    }

    public function abcAction($params)
    {
        echo "<h1> Hi from indexController - abcAction</h1>";
        throw new Exception("die die");
    }

    public function defaultAction($params)
    {
        echo "<h1> Hi from indexController - defaultAction</h1>";
        echo "<br/>got Params -> ".print_r($params,true);
    }
}

echo "<br/>controller finished</br>";

?>

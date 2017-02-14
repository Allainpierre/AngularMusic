<?php

class controller
{
    protected $vars = array();

    function __construct()
    {
        if (isset($_POST))
        {
            $this->set($_POST);
        }
    }

    public function set($d)
    {
        $this->vars = array_merge($this->vars, $d);
    }

    public function render($fileName)
    {
        extract($this->vars);
        ob_start();
        require(ROOT . 'views/' . get_class($this) . '/' . $fileName . '.php');
        echo $content_for_layout = ob_get_clean();
    }

    public function popin($fileName)
    {
        extract($this->vars);
        ob_start();
        require(ROOT . 'views/core/' . $fileName . '.php');
        echo $content_for_layout = ob_get_clean();
    }

    public function loadModel($name)
    {
        require_once(ROOT . 'models/' . strtolower($name) . '.php');
        $this->$name = new $name();
    }
}
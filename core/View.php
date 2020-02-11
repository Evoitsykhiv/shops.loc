<?php


namespace core;


class View
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $this->route['controller'].'/'.$this->route['action'];
    }

    public function render($title, $vars = []){
        ob_start();
        require 'views/'.$this->path.'.php';
        $content = ob_get_clean();
        require 'views/layout/'.$this->layout.'.php';
    }
}
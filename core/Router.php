<?php
namespace core;

/**
 * Class Router
 * @package core
 */
class Router
{
    protected $routers = [];
    protected $params = [];

    function __construct(){
        $arr = require 'config/routers.php';
        foreach ($arr as $key=>$val) {
            $this->add($key, $val);
        }
    }

    /**
     * @param $router
     * @param $params
     */
    public function add($router, $params){
        $router = '#^'.$router.'$#';
        $this->routers[$router] = $params;
    }

    /**
     * @return bool
     */
    public function match(){
        $url =  trim($_SERVER['REQUEST_URI'], '/');
        foreach($this->routers as $router => $params){
            if(preg_match($router, $url, $matches)){
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run(){
      if($this->match()){
          $path = 'controllers\\'.ucfirst($this->params['controller']).'Controller';
          if(class_exists($path)){
              $action = $this->params['action'].'Action';
              if(method_exists($path, $action)){
                  $controller = new $path;

                  $controller->$action();
              }
          }else{
              echo 'Контролер не найден: '.$path;
          }
      }else{
          echo 'маршрут не найден';
      }

    }
}
<?php

class Dispatcher extends Router
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        
        $url = parent::__construct();
        
        if($url == null)
        {
            header("Location: http://localhost/PHP_Rush_MVC/Webroot/home/index");
            exit();
        }

        if(file_exists('../Controllers/' . ucfirst($url[0]) . 'Controller.php'))
        {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }
  
        require_once '../Controllers/' . $this->controller . 'Controller.php';

        $this->controller = new $this->controller;

        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
            $this->params = $url ? array_values($url) : [];
        }
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
}
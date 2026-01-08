<?php

class App {
    protected $controller = 'AuthController';
    protected $method = 'login';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();
        
        // Check if controller exists
        if(isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }
        
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;
        
        // Check if method exists
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        
        // Get params
        $this->params = $url ? array_values($url) : [];
        
        // Call controller method with params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    public function parseURL() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        
        // Default route - check if user is logged in
        if(Auth::check()) {
            return ['dashboard'];
        } else {
            return ['auth', 'login'];
        }
    }
}
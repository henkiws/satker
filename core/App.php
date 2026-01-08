<?php

class App {
    protected $controller = 'AuthController';
    protected $method = 'index';  // Changed from 'login' to 'index'
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();
        
        // Debug: Log the parsed URL
        error_log("Parsed URL: " . print_r($url, true));
        error_log("Request Method: " . $_SERVER['REQUEST_METHOD']);
        
        // Check if controller exists
        if(isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }
        
        error_log("Loading controller: " . $this->controller);
        
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;
        
        // Check if method exists
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        
        error_log("Calling method: " . $this->method);
        
        // Get params
        $this->params = $url ? array_values($url) : [];
        
        // Call controller method with params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    public function parseURL() {
        // Get the request URI
        $requestUri = $_SERVER['REQUEST_URI'];
        error_log("Request URI: " . $requestUri);
        
        // Remove query string
        $requestUri = strtok($requestUri, '?');
        
        // Remove leading slash
        $requestUri = ltrim($requestUri, '/');
        
        if(empty($requestUri)) {
            // Default route - check if user is logged in
            if(Auth::check()) {
                return ['dashboard', 'index'];  // Add 'index' method
            } else {
                return ['auth', 'login'];
            }
        }
        
        // Split URL into segments
        $url = explode('/', $requestUri);
        error_log("URL segments: " . print_r($url, true));
        
        return $url;
    }
}
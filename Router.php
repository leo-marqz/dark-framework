<?php 

require("./HttpMethod.php");
require("./HttpNotFoundException.php");

class Router {
    protected array $routes = [];

    public function __construct(){
        foreach(HttpMethod::cases() as $method){
            $this->routes[$method->value] = [];
        }

    }

    public function get(string $uri, callable $action){
        $this->routes[HttpMethod::GET->value][$uri] = $action;
    }
    public function post(string $uri, callable $action){
        $this->routes[HttpMethod::POST->value][$uri] = $action;
    }
    public function put(string $uri, callable $action){
        $this->routes[HttpMethod::PUT->value][$uri] = $action;
    }
    public function delete(string $uri, callable $action){
        $this->routes[HttpMethod::DELETE->value][$uri] = $action;
    }

    public function resolve(){
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        $action = $this->routes[$method][$uri] ?? null;

        if($action == null){
            throw new HttpNotFoundException();
        }

        return $action;
    }
}
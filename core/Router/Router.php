<?php

namespace Core\Router;

use ReflectionMethod;

class Router
{
    protected array $current_route;
    protected string $method_field;
    protected array $routes;
    private array $params = [];

    private $res = false;

    public function __construct()
    {
        $this->current_route = explode('/', CURRENT_ROUTE);
        global $routes;
        $this->routes = $routes;
        $this->method_field = $this->methodField();
    }

    public function methodField(): string
    {
        $method_field = strtolower($_SERVER['REQUEST_METHOD']);

        if ($method_field == 'POST') {
            if ($_POST['_method'] === 'PUT') {
                $method_field = "PUT";
            }
            if ($_POST['_method'] === 'DELETE') {
                $method_field = "DELETE";
            }
        }
        return $method_field;
    }

    public function checkRoute()
    {
        $reserved_routes = $this->routes[$this->method_field];
        foreach ($reserved_routes as $reserved_route) {

            $reserved_route_arr = explode('/', $reserved_route['uri']);
            if (sizeof($this->current_route) == sizeof($reserved_route_arr)) {

                foreach ($reserved_route_arr as $key => $value) {

                    if ($this->current_route[$key] == $value) {
                        if (!empty($reserved_route_arr[$key + 1])) {
                            if (str_starts_with($reserved_route_arr[$key + 1], '{') &&
                                str_ends_with($reserved_route_arr[$key + 1], '}')) {
                                $this->params[] = $this->current_route[$key + 1];
                            } else {
                                $this->params = [];
                            }
                        }
                        $controller = "App\Http\Controllers\\" . $reserved_route['controller'];
                        $obj = new $controller();
                        if (method_exists($obj, $reserved_route['action'])) {
                            $reflection = new ReflectionMethod($controller, $reserved_route['action']);
                            $params = $reflection->getNumberOfParameters();
                            if ($params <= count($this->params)) {
                                call_user_func_array([$obj, $reserved_route['action']], $this->params);
                            }
                        }
                        $this->res = true;
                    }

                }
            }
        }
        if (!$this->res) {
            echo "Controller Not Found";
        }
    }

}
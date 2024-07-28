<?php

namespace Core\Router\Api;
class Route
{
    public static function get($uri, array $context)
    {
        $controller = $context[0];
        $controller = explode('\\', $controller);
        $controller = array_splice($controller, -1)[0];
        $action = $context[1];
        global $routes;
        $routes['get'][] = array('uri' => "api/" . trim($uri, "/ "), 'controller' => $controller, 'action' => $action);
    }

    public static function post($uri, array $context)
    {
        $controller = $context[0];
        $controller = explode('\\', $controller);
        $controller = array_splice($controller, -1)[0];
        $action = $context[1];
        global $routes;
        $routes['post'][] = array('uri' => "api/" . trim($uri, "/ "), 'controller' => $controller, 'action' => $action);
    }

    public static function put($uri, array $context)
    {
        $controller = $context[0];
        $controller = explode('\\', $controller);
        $controller = array_splice($controller, -1)[0];
        $action = $context[1];
        global $routes;
        $routes['put'][] = array('uri' => "api/" . trim($uri, "/ "), 'controller' => $controller, 'action' => $action);
    }

    public static function delete($uri, array $context)
    {
        $controller = $context[0];
        $controller = explode('\\', $controller);
        $controller = array_splice($controller, -1)[0];
        $action = $context[1];
        global $routes;
        $routes['delete'][] = array('uri' => "api/" . trim($uri, "/ "), 'controller' => $controller, 'action' => $action);
    }
}
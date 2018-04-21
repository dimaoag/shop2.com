<?php
namespace shop2;


class Router
{
    protected static $routes = [];
    protected static $route = [];


    /**
     * @param $regexp
     * @param array $route
     */
    public static function add($regexp, $route = []){
        self::$routes[$regexp] = $route;
    }

    /**
     * @return array
     */
    public static function getRoutes(){
        return self::$routes;
    }

    /**
     * @return array
     */
    public static function getRoute(){
        return self::$route;
    }


    public static function dispatch($url){
        if (self::matchRoute($url)){
            echo $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
        } else {
            throw new \Exception('Page not found', 404);
        }
    }

    public static function matchRoute($url){
        foreach (self::$routes as $pattern => $route){
            if (preg_match("#{$pattern}#", $url, $matches)){
                foreach ($matches as $key => $value){
                    if (is_string($key)){
                        $route[$key] = $value;
                    }
                }
                if (empty($route['action'])){
                    $route['action'] = 'index';
                }
                if (!isset($route['prefix'])){
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                debug(self::$route);
                return true;
            }
        }
        return false;
    }

    //CamelCase for controllers
    protected static function upperCamelCase($name){
        $name = str_replace('-', ' ', $name);
        debug($name);
    }

    //camelCase for actions
    protected static function lowerCamelCase($name){
        
    }




}
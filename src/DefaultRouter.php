<?php

namespace Lubed\Router;

use Lubed\Utils\Arr;

use Closure;
use Lubed\Router\Routing\{DefaultRoutingDestination,DefaultRoutingParser,DefaultRoutingRule};

class DefaultRouter implements Router
{
    const PROTOCOL_DEFAULT = 1;

    private $table;

    public function __construct()
    {
        $this->table = new DefaultRouteTable();
    }

    public function addRoute(string $method, string $uri, $options)
    {
        $route = $this->createRoute($method,$uri,$options);
        $key = $route->getKey();
        $callee = $route->getDestination()->getCallee();
        $this->table->add($key,$callee);
    }

    public function head($uri, $options)
    {
        $this->addRoute('HEAD', $uri, $options);

        return $this;
    }

    public function get($uri, $options)
    {
        $this->addRoute('GET', $uri, $options);

        return $this;
    }

    public function post($uri, $options)
    {
        $this->addRoute('POST', $uri, $options);

        return $this;
    }

    public function put($uri, $options)
    {
        $this->addRoute('PUT', $uri, $options);

        return $this;
    }

    public function patch($uri, $options)
    {
        $this->addRoute('PATCH', $uri, $options);

        return $this;
    }

    public function delete($uri, $options)
    {
        $this->addRoute('DELETE', $uri, $options);

        return $this;
    }

    public function options($uri, $options)
    {
        $this->addRoute('OPTIONS', $uri, $options);

        return $this;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    private function createRoute(string $method,string $uri,$options)
    {

        $route_options = $this->createRouteOptions($method,$uri,$options);
        return new DefaultRoute($method,$uri,$route_options);

    }

    private function createRouteOptions(string $method,string $uri, $options):array
    {
        $route_options=[
            'protocol'=>self::PROTOCOL_DEFAULT,
            'destination'=>NULL,
            'next'=>NULL
        ];


        if (is_array($options)) {
            $route_options=array_merge($route_options,$options);
        }

        $destination = null;

        if(is_string($options)) {
            $data = explode('@',$options);
            $class = $data[0]??'';
            $action = $data[1]??'Index';

            if($class && class_exists($class)&&$action){
                $callee=[$class,$action];
                $destination = new DefaultRoutingDestination($callee); 
            }

      
 
        }
        if(!$destination){
            $rule = NULL;

            if (self::PROTOCOL_DEFAULT === $route_options['protocol']) {
                $rule = new DefaultRoutingRule();
                $parser = new DefaultRoutingParser($method,$rule,$this->table);
                $destination= $parser->parse($uri);
            }
        }


        $route_options['destination'] =  $destination;

        return $route_options;
    }


}

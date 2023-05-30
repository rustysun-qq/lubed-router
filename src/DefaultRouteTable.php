<?php

namespace Lubed\Router;

class DefaultRouteTable implements RouteTable
{
    private $routes = [];

    public function __construct(array $routes=[])
    {
        $this->table = $routes;
    }

    public function add(string $key, $callee)
    {
        if(isset($this->routes[$key])) {
            RouterExceptions::routeHasExists(sprintf('The route %s is exists!',$key));
        }
        //TODO:???
        $this->routes[$key]=$callee;
    }

    public function all():array
    {
        return $this->routes;
    }

    public function getByKey(string $key)
    {
        return $this->routes[$key]??NULL;
    }

}
<?php
namespace Lubed\Router;
use Lubed\Router\Routing\RoutingDestination;

interface Router {
    public function addRoute(string $method, string $uri, $options) : void;

    public function getRoutes() : array;

    public function routing(string $method, string $path):?RoutingDestination;
}

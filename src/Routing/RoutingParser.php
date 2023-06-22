<?php
namespace Lubed\Router\Routing;
interface RoutingParser {
    public function parse(string $method, string $uri) : ?RoutingDestination;
}

<?php
namespace Lubed\Router\Routing;
interface RoutingFilter {
    public function filter() : bool;
}
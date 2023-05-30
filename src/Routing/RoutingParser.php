<?php
namespace Lubed\Router\Routing;

interface RoutingParser
{
	public function parse(string $uri):?RoutingDestination;
}

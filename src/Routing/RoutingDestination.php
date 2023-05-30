<?php
namespace Lubed\Router\Routing;

interface RoutingDestination
{
	public function getCallee():array;
	public function setParameters(array $parameters):self;
	public function getParameters():array;
}

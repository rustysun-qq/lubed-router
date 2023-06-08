<?php
namespace Lubed\Router\Routing;

use Lubed\Router\RDI;

interface RoutingDestination
{
	public function getRDI():RDI;
	public function setParameters(array $parameters):self;
	public function getParameters():array;
}

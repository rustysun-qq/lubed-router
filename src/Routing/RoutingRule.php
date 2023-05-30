<?php
namespace Lubed\Router\Routing;

interface RoutingRule
{
	public function getRule():string;
	public function getParametersRule():string;
}
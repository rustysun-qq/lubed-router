<?php
namespace Lubed\Router\Filters;

interface RoutingFilter
{
	public function filter():bool;
}
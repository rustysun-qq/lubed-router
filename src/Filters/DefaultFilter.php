<?php
namespace Lubed\Router\Filters;

class DefaultFilter implements RoutingFilter
{
	public function run():bool
	{
		return true;
	}
}

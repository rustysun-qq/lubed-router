<?php
namespace Lubed\Router\Routing;

class RouteTableFilter implements RoutingFilter
{
	private $uri, $table;

	public function __construct(string $key,RouteTable $table)
	{
		$this->key = $key;
		$this->table = $table;
	}

	public function filter():bool
	{
		$callee = $this->table->getByKey($this->key);

		return ($callee?TRUE:FALSE);
	}
}

<?php
namespace Lubed\Router\Routing;

class DefaultRoutingDestination implements RoutingDestination
{
	private $callee;
	private $parameters;

	public function __construct(array $callee, array $parameters=[])
	{
		$this->callee = $callee;
		$this->parameters = $parameters;
	}

	public function getCallee():array
	{
		return $this->callee;
	}

	public function setParameters(array $parameters):self
	{
		$this->parameters = $parameters;
		return $this;
	}

	public function getParameters():array
	{
		return $this->parameters;
	}
}

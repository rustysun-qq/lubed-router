<?php
namespace Lubed\Router\Routing;

use Lubed\Router\RDI;

class DefaultRoutingDestination implements RoutingDestination
{
	private $rdi;
	private $parameters;

	public function __construct(RDI $rdi, array $parameters=[])
	{
		$this->rdi = $rdi;
		$this->parameters = $parameters;
	}

	public function getRDI():RDI
	{
		return $this->rdi;
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

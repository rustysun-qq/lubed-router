<?php
namespace Lubed\Router;

use Lubed\Router\Routing\RoutingDestination;

interface Route
{
	public function getKey():string;

	public function getMethod():string;

	public function getUri():string;

	public function getDestination():?RoutingDestination;

	public function getNext();
}

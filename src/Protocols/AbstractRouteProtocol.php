<?php
namespace Lubed\Router\Protocols;

abstract class AbstractRouteProtocol implements RouteProtocol
{
	protected $path;
	protected $rule;

	public function __construct(string $path)
	{
		$this->path = $path;
	}

	public function getPath():string
	{
		return $this->path;
	}

	abstract function getProtocol():int;

	public function getRule():?string
	{
		return $this->rule;
	}

	abstract function parse():void;
}

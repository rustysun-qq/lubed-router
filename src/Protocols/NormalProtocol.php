<?php
namespace Lubed\Router\Protocols;

class NormalProtocol extends AbstractRouteProtocol
{
	public function parse():void
	{
		$this->rule = null;
	}

	public function getProtocol():int
	{
		return RouteProtocol::NORMAL;
	}
}

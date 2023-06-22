<?php
namespace Lubed\Router\Protocols;

class RegexpProtocol extends AbstractRouteProtocol
{
	public function parse():void
	{
		$this->rule = $this->path;
	}

	public function getProtocol():int
	{
		return RouteProtocol::REGEXP;
	}
}

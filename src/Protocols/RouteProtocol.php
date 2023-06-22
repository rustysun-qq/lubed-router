<?php
namespace Lubed\Router\Protocols;

interface RouteProtocol
{
	const NORMAL=1;//normal protocol: '/aaa'
	const SIMPLE=2;//simple protocol: '/aaa/{id}-[name]'
	const REGEXP=3;//regexp protocol: '^/aaa/(\d+)-([^/]*)'

	public function getProtocol():int;
	public function parse():void;
	public function getRule():?string;
}
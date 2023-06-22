<?php
namespace Lubed\Router\Protocols;

class SimpleProtocol extends AbstractRouteProtocol
{
	public function parse():void
	{
		preg_match_all('#[\{\[](\w+)[\}\]]#i', $this->path, $matches, \PREG_OFFSET_CAPTURE | \PREG_SET_ORDER);
		if(count($matches)<1){
			return;
		}
		$this->doParse($matches);
	}

	public function getRule():?string
	{
		return $this->rule;
	}

	public function getProtocol():int
	{
		return RouteProtocol::SIMPLE;
	}

	private function doParse(array $matches)
	{
		$pairs=[];
		foreach($matches as $result) {
			$key = $result[0][0];//{id}
			$param_name = $result[1][0];//id
			$is_required = '{'===substr($key,0,1)?true:false;
			$pairs[$key] = sprintf('(\w%s)',$is_required?'+':'*');
		}
		$this->rule = strtr($this->path,$pairs);
	}
}
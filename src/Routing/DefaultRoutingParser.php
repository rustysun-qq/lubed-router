<?php
namespace Lubed\Router\Routing;

use Lubed\Router\RouteTable;
use Lubed\Router\RouterExceptions;

class DefaultRoutingParser implements RoutingParser
{
	private $method, $rule, $table;

	public function __construct(string $method,$rule,RouteTable $table)
	{
		$this->method = $method;
		$this->rule = $rule;
		$this->table = $table;
	}

	public function parse(string $uri):?RoutingDestination
	{
		$parse_uri = $uri;
		$parameters = $this->getParameters($parse_uri);
		$key = sprintf('%s %s',$this->method,rtrim($parse_uri,'/'));
		$rule = $this->rule;
		$result = [];

		$callee = $this->table->getByKey($key);

		if (!$callee) {
			RouterExceptions::routingFailed(sprintf('Invalid Destination of Request(%s)',$key),[
				'class'=>__CLASS__,
				'method'=>__METHOD__
			]);
		}

		return DefaultRoutingDestination($callee, $parameters);
	}

	private function getParameters(string &$uri):array
	{
		$rule = $this->rule;
		$pattern = $rule->getParametersRule();
		$result=[];
		$parameters=[];

		if ($pattern
		 && false !== preg_match_all($pattern,$uri,$result)
		 && count($result) > 1 ) {
			foreach($result[0] as $str)
			{
				$uri = str_replace($str,'',$uri);
			}

			$data = $result[1];

			foreach($data as $str)
			{
				$strs = explode('-',$str);
				$parameters[$strs[0]]=$strs[1];
			}
		}

		return $parameters;
	}
}

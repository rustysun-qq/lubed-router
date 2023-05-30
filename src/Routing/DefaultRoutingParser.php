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

		if (preg_match($rule->getRule(), $parse_uri, $result)>0) {
			$group = '';
			$controller = '';
			$action = '';
			$route_options = [];
			$p = 1;
			$paths = array_filter($result);
			$num = count($paths);
			$action = array_pop($paths);

			if ($num > 3) {
				$group = $paths[1];
			}

			if ($num < 2) {
				$action = 'Index';//default action
				$key = sprintf('%s/%s',$key,$action);
			}

			$controller = $this->table->getByKey($key);

			if (!$controller) {
				RouterExceptions::routingFailed(sprintf('Invalid Destination of Request(%s)',$key),[
					'class'=>__CLASS__,
					'method'=>__METHOD__
				]);
			}

			$callee = [$controller, $action];
			$options = [];

			if ($group) {
				$options['group'] = $group;
			}

			return DefaultRoutingDestination($callee, $parameters, $options);
		}

		return NULL;
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

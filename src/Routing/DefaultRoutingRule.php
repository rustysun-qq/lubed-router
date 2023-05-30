<?php
namespace Lubed\Router\Routing;

class DefaultRoutingRule implements RoutingRule
{
	const RULE_NAME = 'default';

	private $options;
	private $type;
	private $split;

	public function __construct(array $options=[], string $split='/')
	{
		$this->options = $options;
		$this->split = $split;
	}

	public function getName():string
	{
		return self::RULE_NAME;
	}

	public function getOptions():array
	{
		return $this->options;
	}

	public function getRule():string
	{
		/*
		 * 1. /BEAN(/Index)
		 * 2. /BEAN/(Index)
		 * 3. /BEAN/ACTION
		 * 4. /BEAN/ACTION/
		 */
		return '/\/([^\/]+)\/?([^\/]*)\/?([^\/]*)\/?/';
	}

	public function getParametersRule():string
	{
		return '/\/([^\/\-]+\-[^\/]+)/';
	}
}

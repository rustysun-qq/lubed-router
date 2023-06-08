<?php
namespace Lubed\Router;

use Lubed\Supports\Starter;
use Lubed\Container\Container;

final class RouterStarter implements Starter
{
	private $loader;
	private $app;

	public function __construct(string $config_file, Container &$app)
	{
		$this->loader = new DefaultRouterLoader($config_file);
		$this->app=$app;
	}

	public function start()
	{
		$this->app->instance('lubed_router_router', $this->loader->load());
	}
}

<?php
namespace Lubed\Router;

use Lubed\Supports\Starter;

final class DefaultStarter implements Starter
{
	private $loader;
	private ?Router $router;

	public function __construct(string $config_file)
	{
		$this->router = NULL;
		$this->loader = new DefaultRouterLoader($config_file);
	}

	public function start()
	{
		$this->router = $this->loader->load();
	}

	public function getInstance():?Router
	{
		return $this->router;
	}
}

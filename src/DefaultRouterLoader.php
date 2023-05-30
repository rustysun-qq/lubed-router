<?php
namespace Lubed\Router;

class DefaultRouterLoader
{
	private $router;
	private $path;

	public function __construct(string $path)
	{
		$this->router = new DefaultRouter();
		$this->path = $path;
	}

	public function load():Router
	{
		$loader = function(string $path, Router &$router) {
			if (!is_file($path)) {
				return $router;
			}

			require_once($path);
		};

		$loader($this->path, $this->router);
		return $this->router;
	}
}

<?php
namespace Lubed\Router;

use Lubed\Supports\Starter;
use Lubed\Utils\Registry;

final class RouterStarter implements Starter {
    private $loader;
    private string $routesFile;

    public function __construct(string $routes_file) {
        $this->routesFile=$routes_file;
        $this->loader=new DefaultRouterLoader;
    }

    public function start() {
        $registry=Registry::getInstance();
        $registry->set('lubed_router_router', $this->loader->load($this->routesFile));
    }
}

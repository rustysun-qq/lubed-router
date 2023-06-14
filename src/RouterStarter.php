<?php
namespace Lubed\Router;

use Lubed\Supports\Starter;
use Lubed\Utils\Registry;

final class RouterStarter implements Starter {
    private $loader;
    private $app;

    public function __construct(string $config_file) {
        $this->loader=new DefaultRouterLoader($config_file);
    }

    public function start() {
        $registry=Registry::getInstance();
        $registry->set('lubed_router_router', $this->loader->load());
    }
}

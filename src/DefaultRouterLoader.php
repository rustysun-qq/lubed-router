<?php
namespace Lubed\Router;
class DefaultRouterLoader {
    private $router;

    public function __construct() {
        $this->router=(new DefaultRouter)->withRouteTable();
    }

    public function load(string $path) : Router {
        $loader=function(string $path, Router &$router) {
            if (!is_file($path)) {
                return $router;
            }
            require_once($path);
        };
        $loader($path, $this->router);
        return $this->router;
    }
}

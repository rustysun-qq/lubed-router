<?php
namespace Lubed\Router\Protocols;
class RouteProtocolResolver {
    public function resolve(string $path) : RouteProtocol {
        $protocol=$this->getProtocol($path);
        $protocol->parse();
        return $protocol;
    }

    private function getProtocol(string $path) : RouteProtocol {
        if ('^' === substr($path, 0, 1)) {
            return new RegexpProtocol($path);
        }
        if (false !== strpos($path, '[') || false !== strpos($path, '{')) {
            return new SimpleProtocol($path);
        }
        return new NormalProtocol($path);
    }
}

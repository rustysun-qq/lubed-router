<?php
namespace Lubed\Router;

use Lubed\Router\Routing\RoutingDestination;

final class DefaultRoute implements Route {
    private $method;
    private $key;
    private $uri;
    private $options;

    public function __construct(string $method, string $uri, array $options=[]) {
        $this->method=$method;
        $this->uri=sprintf('/%s', trim($uri, '/'));
        $this->key=sprintf('%s %s', $method, $this->uri);
        $this->options=$options;
    }

    public function getKey() : string {
        return $this->key;
    }

    public function getMethod() : string {
        return $this->method;
    }

    public function getUri() : string {
        return $this->uri;
    }

    public function getDestination() : ?RoutingDestination {
        return $this->options['destination'] ?? null;
    }

    public function getNext() {
        return $this->options['next'] ?? null;
    }
}

<?php
namespace Lubed\Router;

use Closure;
use Lubed\Router\Protocols\RouteProtocolResolver;
use Lubed\Router\Routing\{DefaultRoutingDestination, DefaultRoutingParser, RoutingDestination};
use Lubed\Utils\Arr;

class DefaultRouter implements Router {
    private $parser;
    private $rdi_resolver;
    private $table;

    public function __construct() {
        $this->table=null;
        $this->rdi_resolver=new RDIResolver;
    }

    public function withRouteTable(?RouteTable $table=null) : self {
        $this->table=$table;
        if (null === $table) {
            $this->table=new DefaultRouteTable;
        }
        return $this;
    }

    public function addRoute(string $method, string $uri, $options) : void {
        $this->checkTable(__METHOD__);
        $route=$this->createRoute($method, $uri, $options);
        $key=$route->getKey();
        $rdi=$route->getDestination()->getRDI();
        $this->table->add($key, $rdi);
    }

    public function head($uri, $options) {
        $this->addRoute('HEAD', $uri, $options);
        return $this;
    }

    public function get($uri, $options) {
        $this->addRoute('GET', $uri, $options);
        return $this;
    }

    public function post($uri, $options) {
        $this->addRoute('POST', $uri, $options);
        return $this;
    }

    public function put($uri, $options) {
        $this->addRoute('PUT', $uri, $options);
        return $this;
    }

    public function patch($uri, $options) {
        $this->addRoute('PATCH', $uri, $options);
        return $this;
    }

    public function delete($uri, $options) {
        $this->addRoute('DELETE', $uri, $options);
        return $this;
    }

    public function options($uri, $options) {
        $this->addRoute('OPTIONS', $uri, $options);
        return $this;
    }

    public function getRoutes() : array {
        return $this->routes;
    }

    public function routing(string $method, string $path):?RoutingDestination {
        $this->checkTable(__METHOD__);
        $parser=new DefaultRoutingParser($this->table);
        return $parser->parse($method, $path);
    }

    private function checkTable(string $method) {
        if (null === $this->table) {
            RouterExceptions::routeTableFailed('Route table does not initialized!', [
                'method'=>$method
            ]);
        }
    }

    private function createRoute(string $method, string $uri, $options) {
        $route_options=$this->createRouteOptions($method, $uri, $options);
        return new DefaultRoute($method, $uri, $route_options);
    }

    private function createRouteOptions(string $method, string $uri, $options) : array {
        $route_options=[
            'destination'=>null,
            'next'=>null
        ];
        if (is_array($options)) {
            $route_options=array_merge($route_options, $options);
        }
        $destination=$route_options['destination'];
        if (is_string($options)) {
            $rdi=$this->rdi_resolver->resolve($options);
            $rdi_result = new RDIResult($rdi);
            $destination=new DefaultRoutingDestination($rdi_result);
        }
        if (!$destination) {
            RouterExceptions::routingFailed(sprintf('Invalid destination(%s %s)!', $methid, $uri), [
                'method'=>__METHOD__
            ]);
        }
        $route_options['destination']=$destination;
        return $route_options;
    }
}

<?php
namespace Lubed\Router\Routing;

use Lubed\Router\RouteTable;
use Lubed\Router\RouterExceptions;

class DefaultRoutingParser implements RoutingParser {
    private $table;

    public function __construct(RouteTable $table) {
        $this->table=$table;
    }

    public function parse(string $method, string $uri) : ?RoutingDestination {
        $parse_uri=$uri;
        $path=sprintf('%s %s', $method, rtrim($parse_uri, '/'));
        $result=[];
        $rdi_result=$this->table->getByPath($path);
        if (!$rdi_result) {
            RouterExceptions::routingFailed(sprintf('Invalid Destination of Request(%s)', $key), [
                'method'=>__METHOD__
            ]);
        }
        return new DefaultRoutingDestination($rdi_result);
    }
}

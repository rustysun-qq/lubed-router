<?php
namespace Lubed\Router;

use Lubed\Router\Protocols\RouteProtocol;
use Lubed\Router\Protocols\RouteProtocolResolver;

/**
 * Default route table
 */
class DefaultRouteTable implements RouteTable {
    private $routes=[];
    private $resolver;

    public function __construct(array $routes=[]) {
        $this->table=$routes;
        $this->resolver=new RouteProtocolResolver;
    }

    public function add(string $key, RDI $rdi) {
        if (isset($this->routes[$key])) {
            RouterExceptions::routeHasExists(sprintf('The route %s is exists!', $key));
        }
        $this->routes[$key]=$rdi;
    }

    public function all() : array {
        return $this->routes;
    }

    public function getByPath(string $path) : ?RDIResult {
        $rdi=$this->routes[$path] ?? null;
        if (null !== $rdi) {
            return new RDIResult($rdi);
        }
        return $this->scanTable($path);
    }

    private function scanTable(string $str):?RDIResult {
        $pathInfo=explode(' ', $str);
        $method = $pathInfo[0]??'';
        $path=$pathInfo[1] ?? '';
        foreach ($this->routes as $key=>$rdi) {
            $key_info=explode(' ', $key);
            $key_method = $key_info[0]??null;
            if($method !== $key_method){
                continue;
            }
            $key_path=$key_info[1] ?? '';
            $resolved=$this->resolver->resolve($key_path);
            $protocol=$resolved->getProtocol();
            if (RouteProtocol::NORMAL === $protocol) {
                continue;
            }
            if (RouteProtocol::SIMPLE === $protocol) {
                $pattern=sprintf('#^%s$#i', $resolved->getRule());
                preg_match($pattern, $path, $matches);
                if (empty($matches)) {
                    continue;
                }
                $parameters=array_slice($matches, 1);
                return new RDIResult($rdi, $parameters);
            }
            //REGEXP
            $pattern=sprintf('#%s#i', $resolved->getRule());
            preg_match($pattern, $path, $matches);
            if (empty($matches)) {
                continue;
            }
            $parameters=array_slice($matches, 1);
            return new RDIResult($rdi, $parameters);
        }
        return NULL;
    }
}

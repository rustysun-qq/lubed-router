<?php
namespace Lubed\Router;
interface RouteTable {
    public function getByPath(string $path);
}

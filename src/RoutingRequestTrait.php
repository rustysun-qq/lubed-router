<?php
namespace Lubed\Router;

use Lubed\Http\Request;

//USED BY REQUEST
trait RoutingRequestTrait
{
    private bool $is_routed=FALSE;

    public function isRouted():bool
    {
        return $this->is_routed;
    }

    public function routeRequest(Request &$request):Route
    {
        $method = $request->getMethod();
        $uri =$request->getUri();
        $path = $uri->getPath();
        $query = $uri->getQuery();
        $parameters=[];
        parse_str($query,$parameters);
        $options = [
            'parameters'=>$parameters
        ];
        $route = new DefaultRoute($method,$path,$options);
print_r($route);
die;
        $request->setRouted(true);

        return $route;
    }
}

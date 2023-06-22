<?php
namespace Lubed\Router\Routing;

use Lubed\Router\RDI;
use Lubed\Router\RDIResult;

class DefaultRoutingDestination implements RoutingDestination {
    private RDIResult $rdi_result;

    public function __construct(RDIResult $result) {
        $this->rdi_result=$result;
    }

    public function getRDI() : RDI {
        return $this->rdi_result->getRdi();
    }

    public function getParameters() : ?array {
        return $this->rdi_result->getParamters();
    }
}

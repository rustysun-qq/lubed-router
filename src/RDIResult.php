<?php
namespace Lubed\Router;
class RDIResult {
    private $rdi;
    private $paramters;

    public function __construct(RDI $rdi, ?array $parameters=null) {
        $this->rdi=$rdi;
        $this->paramters=$parameters;
    }

    /**
     * @return RDI
     */
    public function getRdi() : RDI {
        return $this->rdi;
    }

    /**
     * @return array|null
     */
    public function getParamters() : ?array {
        return $this->paramters;
    }
}

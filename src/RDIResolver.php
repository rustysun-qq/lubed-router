<?php
namespace Lubed\Router;
final class RDIResolver {
    public function __construct() {
    }

    /*
     * RDI RESOLVE:
     * 'namespace::module/controller@action'
     * 'namespace::module/controller'
     * 'namespace::controller@action'
     * 'namespace::controller'
     * 'namespace::@action'
     * 'module/controller@action'
     * 'module/controller'
     * 'controller@action'
     * '/controller'
     * 'controller'
     * '@action'
     */
    public function resolve(string $str) : RDI {
        $rdi=new RDI;
        $pattern='/([^:\/\@]*):{0,2}([^\/\@]*)\/?([^\@]*)\@?([^@]*)$/i';
        $data=$this->getMatchedResult($pattern, $str);
        if ($data) {
            $rdi->setData($data);
        }
        return $rdi;
    }

    private function getMatchedResult(string $pattern, string $str) : array {
        $result=[];
        $matches=[];
        $has_domain=(false !== strpos($str, ':'));
        $has_module=(false !== strpos($str, '/'));
        if (!preg_match($pattern, $str, $matches) || count($matches) < 2) {
            return $result;
        }
        $value=$matches[1] ?? null;
        if ($value) {
            if ($has_domain) {
                $result[RDI::DOMAIN]=$value;
            } elseif ($has_module) {
                $result[RDI::MODULE]=$value;
            } else {
                $result[RDI::CONTROLLER]=$value;
            }
        }
        $value=$matches[2] ?? null;
        if ($value) {
            if ($has_module) {
                $result[RDI::MODULE]=$value;
            } else {
                $result[RDI::CONTROLLER]=$value;
            }
        }
        $value=$matches[3] ?? null;
        if ($value) {
            $result[RDI::CONTROLLER]=$value;
        }
        $value=$matches[4] ?? null;
        if ($value) {
            $result[RDI::ACTION]=$value;
        }
        return $result;
    }
}

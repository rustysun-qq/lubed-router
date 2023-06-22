<?php
namespace Lubed\Router;

/**
 * RDI(Route Destination Identifier)
 * domain::module/controller@action
 */
final class RDI
{
    public const CONTROLLER = 'controller';
    public const ACTION = 'action';
    public const MODULE = 'module';
    public const DOMAIN = 'domain';
    public const DEFAULT_CONTROLLER = 'index';
    public const DEFAULT_ACTION = 'index';
    public const DEFAULT_MODULE = 'default';
    public const DEFAULT_DOMAIN = 'default';

	private $rdi;

	public function __construct()
	{
		$this->rdi=[
    		RDI::CONTROLLER=>RDI::DEFAULT_CONTROLLER,
      		RDI::ACTION=>RDI::DEFAULT_ACTION,
     		RDI::DOMAIN=>RDI::DEFAULT_DOMAIN,
     		RDI::MODULE=>RDI::DEFAULT_MODULE,
    	];
	}

	public function getAction():string
	{
		return $this->rdi[self::ACTION];
	}

	public function getController():string
	{
		return $this->rdi[self::CONTROLLER];
	}
	public function getDomain():string
	{
		return $this->rdi[self::DOMAIN];
	}

	public function getModule():string
	{
		return $this->rdi[self::MODULE];
	}

	public function setData(array $rdi):void
	{
		$this->rdi = array_merge($this->rdi,$rdi);
	}

	public function toArray():array{
		return $this->rdi;
	}

    public function toString():string
    {
        return vsprintf("%s::%s/%s@%s",[
        	$this->getDomain(),$this->getController(),
        	$this->getAction(),$this->getDomain()
        ]);
    }
}

<?php
namespace Lubed\Router;

use Lubed\Exceptions\RuntimeException;

final class RouterExceptions
{
	const ROUTING_FAILED=101401;
	const ROUTE_HAS_EXISTS=101402;
	const ROUTE_TABLE_FAILED = 101403;

	public static function routeTableFailed(string $msg,array $options=[]):RuntimeException {
		throw new RuntimeException(self::ROUTE_TABLE_FAILED, $msg, $options);
	}

	public static function routingFailed(string $msg,array $options=[]):RuntimeException {
		throw new RuntimeException(self::ROUTING_FAILED, $msg, $options);
	}

	public static function routeHasExists(string $msg,array $options=[]):RuntimeException {
		throw new RuntimeException(self::ROUTE_HAS_EXISTS, $msg, $options);
	}

}
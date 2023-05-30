<?php
namespace Lubed\Router;

use Lubed\Exceptions\RuntimeException;

final class RouterExceptions
{
	const ROUTING_FAILED=100401;
	const ROUTE_HAS_EXISTS=100402;

	public static function routingFailed(string $msg,array $options=[]):RuntimeException {
		throw new RuntimeException(self::ROUTING_FAILED, $msg, $options);
	}

	public static function routeHasExists(string $msg,array $options=[]):RuntimeException {
		throw new RuntimeException(self::ROUTE_HAS_EXISTS, $msg, $options);
	}
}
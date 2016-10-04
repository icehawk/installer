<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__\Application\Responses;

use IceHawk\IceHawk\Constants\HttpCode;

/**
 * Class NotFound
 * @package __NS_VENDOR__\__NS_PROJECT__\Application\Responses
 */
final class NotFound
{
	public function respond()
	{
		header( 'Content-Type: text/plain; charset=utf-8', true, HttpCode::NOT_FOUND );
		echo "404 - Not found";
		flush();
	}
}

<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__\Application\Responses;

use IceHawk\IceHawk\Constants\HttpCode;

/**
 * Class InternalServerError
 * @package __NS_VENDOR__\__NS_PROJECT__\Application\Responses
 */
final class InternalServerError
{
	public function respond()
	{
		header( 'Content-Type: text/html; charset=utf-8', true, HttpCode::INTERNAL_SERVER_ERROR );
		echo "500 - Internal Server Error";
		flush();
	}
}

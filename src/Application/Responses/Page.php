<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__\Application\Responses;

use IceHawk\IceHawk\Constants\HttpCode;

/**
 * Class Page
 * @package __NS_VENDOR__\__NS_PROJECT__\Application\Responses
 */
final class Page
{
	public function respond( string $content, int $httpCode = HttpCode::OK )
	{
		header( 'Content-Type: text/html; charset=utf-8', true, $httpCode );

		# Implement you layout rendering here

		echo '<p>', $content, '</p>';
		flush();
	}
}

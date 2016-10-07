<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__\Application\Endpoints\Start\Read;

use __NS_VENDOR__\__NS_PROJECT__\Application\Responses\Page;
use IceHawk\IceHawk\Interfaces\HandlesGetRequest;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;

/**
 * Class SayHelloRequestHandler
 * @package __NS_VENDOR__\__NS_PROJECT__\Application\Endpoints\Start\Read
 */
final class SayHelloRequestHandler implements HandlesGetRequest
{
	public function handle( ProvidesReadRequestData $request )
	{
		# This method handles a GET (and HEAD) request

		# And responds with a 200 OK and page content

		(new Page())->respond( file_get_contents( __DIR__ . '/Pages/hello.html' ) );
	}
}

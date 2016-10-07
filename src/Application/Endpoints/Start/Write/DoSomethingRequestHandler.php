<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__\Application\Endpoints\Start\Write;

use __NS_VENDOR__\__NS_PROJECT__\Application\Responses\Redirect;
use IceHawk\IceHawk\Interfaces\HandlesPostRequest;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;

/**
 * Class DoSomethingRequestHandler
 * @package __NS_VENDOR__\__NS_PROJECT__\Application\Endpoints\Start\Write
 */
final class DoSomethingRequestHandler implements HandlesPostRequest
{
	public function handle( ProvidesWriteRequestData $request )
	{
		# This method handles a post request

		# And responds with a 301 redirect back to /

		(new Redirect( "/" ))->respond();
	}
}

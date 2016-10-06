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
		# Do something with your data here

		$number = $request->getInput()->get( 'number' );

		(new Redirect( "/show/{$number}" ))->respond();
	}
}

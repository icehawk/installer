<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__\Application\Endpoints\Start\Read;

use IceHawk\IceHawk\Interfaces\HandlesGetRequest;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;

/**
 * Class ShowNumberRequestHandler
 * @package __NS_VENDOR__\__NS_PROJECT__\Application\Endpoints\Start\Read
 */
final class ShowNumberRequestHandler implements HandlesGetRequest
{
	public function handle( ProvidesReadRequestData $request )
	{
		# Note: This parameter comes out of the URI
		$number = $request->getInput()->get( 'number' );


	}
}

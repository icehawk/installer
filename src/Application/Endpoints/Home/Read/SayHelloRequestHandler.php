<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__\Application\Endpoints\Home\Read;

use __NS_VENDOR__\__NS_PROJECT__\Application\Responses\Page;
use IceHawk\IceHawk\Interfaces\HandlesGetRequest;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;

/**
 * Class SayHelloRequestHandler
 * @package __NS_VENDOR__\__NS_PROJECT__\Application\Endpoints\Home\Read
 */
final class SayHelloRequestHandler implements HandlesGetRequest
{
	public function handle( ProvidesReadRequestData $request )
	{
		(new Page())->respond( 'Hello World!' );
	}
}

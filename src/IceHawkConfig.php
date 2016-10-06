<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__;

use __NS_VENDOR__\__NS_PROJECT__\Application\Endpoints\Start\Read\SayHelloRequestHandler;
use __NS_VENDOR__\__NS_PROJECT__\Application\Endpoints\Start\Write\DoSomethingRequestHandler;
use __NS_VENDOR__\__NS_PROJECT__\Application\EventSubscribers\IceHawkInitEventSubscriber;
use __NS_VENDOR__\__NS_PROJECT__\Application\EventSubscribers\IceHawkReadEventSubscriber;
use __NS_VENDOR__\__NS_PROJECT__\Application\EventSubscribers\IceHawkWriteEventSubscriber;
use __NS_VENDOR__\__NS_PROJECT__\Application\FinalResponders\FinalReadResponder;
use __NS_VENDOR__\__NS_PROJECT__\Application\FinalResponders\FinalWriteResponder;
use IceHawk\IceHawk\Defaults\Traits\DefaultRequestInfoProviding;
use IceHawk\IceHawk\Interfaces\ConfiguresIceHawk;
use IceHawk\IceHawk\Interfaces\RespondsFinallyToReadRequest;
use IceHawk\IceHawk\Interfaces\RespondsFinallyToWriteRequest;
use IceHawk\IceHawk\Routing\Patterns\Literal;
use IceHawk\IceHawk\Routing\ReadRoute;
use IceHawk\IceHawk\Routing\WriteRoute;

/**
 * Class IceHawkConfig
 * @package __NS_VENDOR__\__NS_PROJECT__
 */
final class IceHawkConfig implements ConfiguresIceHawk
{
	use DefaultRequestInfoProviding;

	public function getReadRoutes()
	{
		# Define your read routes (GET / HEAD) here
		# For matching the URI you can use the Literal, RegExp or NamedRegExp pattern classes

		return [
			new ReadRoute( new Literal( '/' ), new SayHelloRequestHandler() ),
		];
	}

	public function getWriteRoutes()
	{
		# Define your write routes (POST / PUT / PATCH / DELETE) here
		# For matching the URI you can use the Literal, RegExp or NamedRegExp pattern classes

		return [
			new WriteRoute( new Literal( '/do-something' ), new DoSomethingRequestHandler() ),
		];
	}

	public function getEventSubscribers() : array
	{
		# Register your subscribers for IceHawk events here

		return [
			new IceHawkInitEventSubscriber(),
			new IceHawkReadEventSubscriber(),
			new IceHawkWriteEventSubscriber(),
		];
	}

	public function getFinalReadResponder() : RespondsFinallyToReadRequest
	{
		# Provide a final responder for read requests here

		return new FinalReadResponder();
	}

	public function getFinalWriteResponder() : RespondsFinallyToWriteRequest
	{
		# Provide a final responder for write requests here

		return new FinalWriteResponder();
	}
}

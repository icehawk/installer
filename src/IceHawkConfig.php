<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__;

use __NS_VENDOR__\__NS_PROJECT__\Application\Endpoints\Home\Read\SayHelloRequestHandler;
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

/**
 * Class IceHawkConfig
 * @package __NS_VENDOR__\__NS_PROJECT__
 */
final class IceHawkConfig implements ConfiguresIceHawk
{
	use DefaultRequestInfoProviding;

	public function getReadRoutes()
	{
		return [
			new ReadRoute( new Literal( '/' ), new SayHelloRequestHandler() ),
		];
	}

	public function getWriteRoutes()
	{
		return [
			# Add your first write route here
		];
	}

	public function getEventSubscribers() : array
	{
		return [
			new IceHawkReadEventSubscriber(),
			new IceHawkWriteEventSubscriber(),
		];
	}

	public function getFinalReadResponder() : RespondsFinallyToReadRequest
	{
		return new FinalReadResponder();
	}

	public function getFinalWriteResponder() : RespondsFinallyToWriteRequest
	{
		return new FinalWriteResponder();
	}
}

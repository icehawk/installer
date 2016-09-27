<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__\Application;

use __NS_VENDOR__\__NS_PROJECT__\Application\Endpoints\Home\Read\ShowHomepageRequestHandler;
use IceHawk\IceHawk\Defaults\Traits\DefaultEventSubscribing;
use IceHawk\IceHawk\Defaults\Traits\DefaultFinalReadResponding;
use IceHawk\IceHawk\Defaults\Traits\DefaultFinalWriteResponding;
use IceHawk\IceHawk\Defaults\Traits\DefaultRequestInfoProviding;
use IceHawk\IceHawk\Interfaces\ConfiguresIceHawk;
use IceHawk\IceHawk\Routing\Patterns\Literal;
use IceHawk\IceHawk\Routing\ReadRoute;

/**
 * Class IceHawkConfig
 * @package __NS_VENDOR__\__NS_PROJECT__\Application
 */
final class IceHawkConfig implements ConfiguresIceHawk
{
	use DefaultRequestInfoProviding;
	use DefaultEventSubscribing;
	use DefaultFinalReadResponding;
	use DefaultFinalWriteResponding;

	public function getReadRoutes()
	{
		return [
			new ReadRoute( new Literal( '/' ), new ShowHomepageRequestHandler() ),
		];
	}

	public function getWriteRoutes()
	{
		return [];
	}
}

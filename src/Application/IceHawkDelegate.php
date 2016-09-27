<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__\Application;

use IceHawk\IceHawk\Interfaces\ProvidesRequestInfo;
use IceHawk\IceHawk\Interfaces\SetsUpEnvironment;

/**
 * Class IceHawkDelegate
 * @package __NS_VENDOR__\__NS_PROJECT__\Application
 */
final class IceHawkDelegate implements SetsUpEnvironment
{
	public function setUpGlobalVars()
	{
		// TODO: Implement setUpGlobalVars() method.
	}

	public function setUpErrorHandling( ProvidesRequestInfo $requestInfo )
	{
		// TODO: Implement setUpErrorHandling() method.
	}

	public function setUpSessionHandling( ProvidesRequestInfo $requestInfo )
	{
		// TODO: Implement setUpSessionHandling() method.
	}
}

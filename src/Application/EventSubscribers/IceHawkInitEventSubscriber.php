<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__\Application\EventSubscribers;

use IceHawk\IceHawk\Events\IceHawkWasInitializedEvent;
use IceHawk\IceHawk\Events\InitializingIceHawkEvent;
use IceHawk\IceHawk\PubSub\AbstractEventSubscriber;

/**
 * Class IceHawkInitEventSubscriber
 * @package __NS_VENDOR__\__NS_PROJECT__\Application\EventSubscribers
 */
final class IceHawkInitEventSubscriber extends AbstractEventSubscriber
{
	protected function getAcceptedEvents() : array
	{
		return [
			InitializingIceHawkEvent::class,
			IceHawkWasInitializedEvent::class,
		];
	}

	protected function whenInitializingIceHawk( InitializingIceHawkEvent $event )
	{
		# This method is called AFTER setUpGlobalVars and getRequestInfo
		# and BEFORE setUpErrorHandling and setUpSessionHandling

		# You can access the request info via $event->getRequestInfo()
	}

	protected function whenIceHawkWasInitialized( IceHawkWasInitializedEvent $event )
	{
		# This method is called AFTER setUpErrorHandling and setUpSessionHandling

		# You can access the request info via $event->getRequestInfo()
	}
}

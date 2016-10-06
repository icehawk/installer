<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__\Application\EventSubscribers;

use IceHawk\IceHawk\Events\HandlingWriteRequestEvent;
use IceHawk\IceHawk\Events\WriteRequestWasHandledEvent;
use IceHawk\IceHawk\PubSub\AbstractEventSubscriber;

/**
 * Class IceHawkWriteEventSubscriber
 * @package __NS_VENDOR__\__NS_PROJECT__\Application\EventSubscribers
 */
final class IceHawkWriteEventSubscriber extends AbstractEventSubscriber
{
	protected function getAcceptedEvents() : array
	{
		return [
			HandlingWriteRequestEvent::class,
			WriteRequestWasHandledEvent::class,
		];
	}

	public function whenHandlingWriteRequest( HandlingWriteRequestEvent $event )
	{
		# This method is called BEFORE the request handler handles the write request

		# You can access the request info via $event->getRequestInfo()
		# You can access the request input via $event->getRequestInput()
	}

	public function whenWriteRequestWasHandled( WriteRequestWasHandledEvent $event )
	{
		# This method is called AFTER the request handler has handled the write request

		# You can access the request info via $event->getRequestInfo()
		# You can access the request input via $event->getRequestInput()
	}
}

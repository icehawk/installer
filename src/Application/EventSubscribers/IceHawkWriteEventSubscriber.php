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
	/** @var float */
	private $startTime;

	protected function getAcceptedEvents() : array
	{
		return [
			HandlingWriteRequestEvent::class,
			WriteRequestWasHandledEvent::class,
		];
	}

	public function whenHandlingWriteRequest( HandlingWriteRequestEvent $event )
	{
		$this->startTime = microtime( true );
	}

	public function whenWriteRequestWasHandled( WriteRequestWasHandledEvent $event )
	{
		echo "The write request on {$event->getRequestInfo()->getUri()} was handled in "
		     . (microtime( true ) - $this->startTime) . " seconds.";
	}
}

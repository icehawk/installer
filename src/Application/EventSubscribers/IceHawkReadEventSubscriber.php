<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__\Application\EventSubscribers;

use IceHawk\IceHawk\Events\HandlingReadRequestEvent;
use IceHawk\IceHawk\Events\ReadRequestWasHandledEvent;
use IceHawk\IceHawk\PubSub\AbstractEventSubscriber;

/**
 * Class IceHawkReadEventSubscriber
 * @package __NS_VENDOR__\__NS_PROJECT__\Application\EventSubscribers
 */
final class IceHawkReadEventSubscriber extends AbstractEventSubscriber
{
	/** @var float */
	private $startTime;

	protected function getAcceptedEvents() : array
	{
		return [
			HandlingReadRequestEvent::class,
			ReadRequestWasHandledEvent::class,
		];
	}

	public function whenHandlingReadRequest( HandlingReadRequestEvent $event )
	{
		$this->startTime = microtime( true );
	}

	public function whenReadRequestWasHandled( ReadRequestWasHandledEvent $event )
	{
		echo "The request on {$event->getRequestInfo()->getUri()} was handled in "
		     . (microtime( true ) - $this->startTime) . " seconds.";
	}
}

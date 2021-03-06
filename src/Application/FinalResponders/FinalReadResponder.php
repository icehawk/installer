<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__\Application\FinalResponders;

use __NS_VENDOR__\__NS_PROJECT__\Application\Responses\InternalServerError;
use __NS_VENDOR__\__NS_PROJECT__\Application\Responses\NotFound;
use IceHawk\IceHawk\Exceptions\UnresolvedRequest;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;
use IceHawk\IceHawk\Interfaces\RespondsFinallyToReadRequest;

/**
 * Class FinalReadResponder
 * @package __NS_VENDOR__\__NS_PROJECT__\Application\FinalResponders
 */
final class FinalReadResponder implements RespondsFinallyToReadRequest
{
	public function handleUncaughtException( \Throwable $throwable, ProvidesReadRequestData $request )
	{
		try
		{
			throw $throwable;
		}
		catch ( UnresolvedRequest $e )
		{
			# No matching route was found, respond with a 404 Not Found

			(new NotFound())->respond();
		}
		catch ( \Throwable $e )
		{
			# Something else went wrong, respond with a 500 Internal Server Error

			(new InternalServerError())->respond();
		}
	}
}

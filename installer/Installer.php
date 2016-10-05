<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace IceHawk;

use IceHawk\Installer\ConsoleCommands\InstallInteractive;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

require(__DIR__ . '/../vendor/autoload.php');

/**
 * Class Installer
 * @package IceHawk
 */
final class Installer
{
	public static function postCreateProject()
	{
		try
		{
			$app = new Application( 'IceHawk Installer', '1.0' );
			$app->add( new InstallInteractive( 'install:interactive' ) );
			$app->find( 'install:interactive' )->run( new ArgvInput(), new ConsoleOutput() );
		}
		catch ( \Throwable $e )
		{
			echo get_class( $e ) . ' thrown with message: ' . $e->getMessage() . PHP_EOL;
			echo $e->getTraceAsString() . PHP_EOL;

			exit(1);
		}
	}
}


<?php declare(strict_types = 1);
/**
 * Copyright (c) 2016-2017 Holger Woltersdorf & Contributors
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 */

namespace IceHawk\Installer;

use IceHawk\Installer\ConsoleCommands\InstallInteractive;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

require(__DIR__ . '/../vendor/autoload.php');

/**
 * Class Installer
 * @package IceHawk\Installer
 */
final class Installer
{
	public static function postCreateProject()
	{
		try
		{
			$app = new Application( 'IceHawk Installer', '1.3' );
			$app->add( new InstallInteractive( 'install:interactive' ) );
			$app->find( 'install:interactive' )->run( new ArgvInput( [] ), new ConsoleOutput() );
		}
		catch ( \Throwable $e )
		{
			echo get_class( $e ) . ' thrown with message: ' . $e->getMessage() . PHP_EOL;
			echo $e->getTraceAsString() . PHP_EOL;

			exit(1);
		}
	}
}

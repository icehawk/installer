<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace IceHawk\Installer\ConsoleCommands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class InstallInteractive
 * @package IceHawk\Installer\ConsoleCommands
 */
final class InstallInteractive extends Command
{
	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$logger = new ConsoleLogger( $output );
		$style  = new SymfonyStyle( $input, $output );

		$style->title( 'Welcome to the IceHawk installer. ' );
		$style->section( 'Please answer the following questions.' );

		$replacements = [];
		$components   = [
			'Forms'   => false,
			'Session' => false,
			'PubSub'  => false,
		];

		$replacements['__NS_VENDOR__']  = $style->ask( 'What is your vendor namespace?', 'MyVendor' );
		$replacements['__NS_PROJECT__'] = $style->ask( 'What is your project namespace?', 'MyProject' );
		$replacements['__AUTHOR__']     = $style->ask( 'What is your author name?', get_current_user() );

		$installMoreComponents = $style->confirm( 'Do you want to install more IceHawk components?', false );

		if ( $installMoreComponents )
		{
			$components['Forms']   = $style->confirm( 'Do you like to use the Forms component?', true );
			$components['Session'] = $style->confirm( 'Do you like to use the Session component?', true );
			$components['PubSub']  = $style->confirm( 'Do you like to use the PubSub component?', true );

			$componentsToInstall = array_filter( $components );
			$componentsToRemove  = array_filter(
				$components,
				function ( bool $installComponent )
				{
					return !$installComponent;
				}
			);
		}
		else
		{
			$componentsToInstall = [];
			$componentsToRemove  = $components;
		}

		$style->section( 'Summary:' );

		$style->table(
			[],
			[
				[ 'Your namespace', $replacements['__NS_VENDOR__'] . '\\' . $replacements['__NS_PROJECT__'] ],
				[ 'Author name', $replacements['__AUTHOR__'] ],
				[
					'Additional components',
					(!empty($componentsToInstall) ? join( ', ', array_keys( $componentsToInstall ) ) : 'none'),
				],
			]
		);

		$installNow = $style->choice(
			'All settings correct?',
			[ 'Yes', 'Change settings', 'Cancel installation' ],
			'Yes'
		);

		switch ( $installNow )
		{
			case 'Yes':
			{
				$style->success( 'Installing your IceHawk project now.' );

				$this->replaceValuesInFiles( $replacements, __DIR__ . '/../../src' );
				$this->installComponents( array_keys( $componentsToInstall ) );
				$this->removeComponents( array_keys( $componentsToRemove ) );

				$style->text( 'Thank you for using the IceHawk framework.' );

				break;
			}
			case 'Change settings':
			{
				$command = $this->getApplication()->find( 'install:interactive' );

				return $command->execute( $input, $output );

				break;
			}
			case 'Cancel installation':
			{
				$style->error( 'Installation canceled.' );

				return 9;
			}
		}

		return 0;
	}

	private function replaceValuesInFiles( array $replacements, string $baseDir )
	{
		$dir      = new \RecursiveDirectoryIterator( $baseDir, \FilesystemIterator::SKIP_DOTS );
		$iterator = new \RecursiveIteratorIterator( $dir );

		/** @var \SplFileInfo $item */
		foreach ( $iterator as $item )
		{
			if ( !$item->isFile() )
			{
				continue;
			}

			$content = file_get_contents( $item->getPathname() );
			str_replace( array_keys( $replacements ), array_values( $replacements ), $content );
			file_put_contents( $item->getPathname(), $content );
		}
	}

	private function installComponents( array $components )
	{
	}

	private function removeComponents( array $components )
	{
	}
}

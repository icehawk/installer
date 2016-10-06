<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace IceHawk\Installer\ConsoleCommands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class InstallInteractive
 * @package IceHawk\Installer\ConsoleCommands
 */
final class InstallInteractive extends Command
{
	const COMP_ICEHAWK          = 'icehawk/icehawk';

	const COMP_FORMS            = 'icehawk/forms';

	const COMP_SESSION          = 'icehawk/session';

	const COMP_PUBSUB           = 'icehawk/pubsub';

	const COMPONENT_VERSION_MAP = [
		self::COMP_ICEHAWK => '2.0.0-rc5',
		self::COMP_FORMS   => '1.0.0-rc4',
		self::COMP_PUBSUB  => '^1.0',
		self::COMP_SESSION => '^1.0',
	];

	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$style = new SymfonyStyle( $input, $output );

		$style->title( 'Welcome to the IceHawk installer. ' );
		$style->section( 'Please answer the following questions.' );

		$replacements = [];
		$components   = [
			self::COMP_ICEHAWK => true,
			self::COMP_FORMS   => false,
			self::COMP_SESSION => false,
			self::COMP_PUBSUB  => false,
		];

		$replacements['__NS_VENDOR__']    = $style->ask( 'What is your vendor namespace?', 'MyVendor' );
		$replacements['__NS_PROJECT__']   = $style->ask( 'What is your project namespace?', 'MyProject' );
		$replacements['__PACKAGE_NAME__'] = $style->ask(
			'What is your package name?',
			strtolower( $replacements['__NS_VENDOR__'] ) . '/' . strtolower( $replacements['__NS_PROJECT__'] )
		);
		$replacements['__AUTHOR_NAME__']  = $style->ask( 'What is your name?', get_current_user() );
		$replacements['__AUTHOR_EMAIL__'] = $style->ask( 'What is your email address?' );

		while ( false === filter_var( $replacements['__AUTHOR_EMAIL__'], FILTER_VALIDATE_EMAIL ) )
		{
			$replacements['__AUTHOR_EMAIL__'] = $style->ask( 'Invalid email address, try again.' );
		}

		$replacements['__AUTHOR__'] = "{$replacements['__AUTHOR_NAME__']} <{$replacements['__AUTHOR_EMAIL__']}>";

		$installMoreComponents = $style->confirm( 'Do you want to install more IceHawk components?', false );

		if ( $installMoreComponents )
		{
			$components[ self::COMP_FORMS ]   = $style->confirm( 'Do you like to use the Forms component?', true );
			$components[ self::COMP_SESSION ] = $style->confirm( 'Do you like to use the Session component?', true );
			$components[ self::COMP_PUBSUB ]  = $style->confirm( 'Do you like to use the PubSub component?', true );
		}

		$componentsToInstall = array_keys( array_filter( $components ) );

		$style->section( 'Summary:' );

		$style->table(
			[],
			[
				['Your namespace', $replacements['__NS_VENDOR__'] . '\\' . $replacements['__NS_PROJECT__']],
				['Your package', $replacements['__PACKAGE_NAME__']],
				['Author name', $replacements['__AUTHOR_NAME__']],
				['Author email', $replacements['__AUTHOR_EMAIL__']],
				[
					'Additional components',
					(!empty($componentsToInstall) ? join( ', ', array_slice( $componentsToInstall, 1 ) ) : 'none'),
				],
			]
		);

		$installNow = $style->choice(
			'All settings correct?',
			['Yes', 'Change settings', 'Cancel installation'],
			'Yes'
		);

		switch ( $installNow )
		{
			case 'Yes':
			{
				$style->text( 'Installing your IceHawk project now.' );

				$this->buildComposerJson( $replacements, $componentsToInstall, __DIR__ . '/../..' );

				$this->replaceValuesInFiles( $replacements, __DIR__ . '/../../public' );
				$this->replaceValuesInFiles( $replacements, __DIR__ . '/../../src' );

				@unlink( __DIR__ . '/../../composer.lock' );
				@unlink( __DIR__ . '/../../Vagrantfile' );
				@unlink( __DIR__ . '/../../LICENSE' );
				@unlink( __DIR__ . '/../../README.md' );
				@unlink( __DIR__ . '/../../CHANGELOG.md' );

				$docRoot = realpath( __DIR__ . '/../../public' );

				$this->installComponents();
				$this->selfDestruct();

				$style->success( 'Your project was installed.' );
				$style->text( '' );
				$style->text( "Now point your webserver's document root to " . $docRoot );
				$style->text( '' );
				$style->text( 'Thank you for using the IceHawk framework.' );
				$style->text( 'Please report installer issues at https://github.com/icehawk/installer/issues' );

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

	private function buildComposerJson( array $replacements, array $components, string $baseDir )
	{
		$json = [
			'name'     => $replacements['__PACKAGE_NAME__'],
			'require'  => [
				'php' => '>=7.0',
			],
			'authors'  => [
				[
					'name'  => $replacements['__AUTHOR_NAME__'],
					'email' => $replacements['__AUTHOR_EMAIL__'],
				],
			],
			'autoload' => [
				'psr-4' => [
					$replacements['__NS_VENDOR__'] . "\\" . $replacements['__NS_PROJECT__'] . "\\" => "src/",
				],
			],
		];

		foreach ( $components as $component )
		{
			$json['require'][ $component ] = self::COMPONENT_VERSION_MAP[ $component ];
		}

		file_put_contents(
			$baseDir . DIRECTORY_SEPARATOR . 'composer.json',
			json_encode( $json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES )
		);
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

			$content = file_get_contents( $item->getRealPath() );
			$content = str_replace( array_keys( $replacements ), array_values( $replacements ), $content );
			file_put_contents( $item->getRealPath(), $content );
		}
	}

	private function installComponents()
	{
		$composerCommand = escapeshellcmd( $_SERVER['argv'][0] );
		$targetDir       = escapeshellarg( realpath( __DIR__ . '/../..' ) );

		$command = 'cd ' . $targetDir . ' && ' . $composerCommand . ' update -q -o';

		shell_exec( $command );
	}

	private function selfDestruct()
	{
		$installerDir = escapeshellarg( realpath( __DIR__ . '/../' ) );

		shell_exec( 'rm -rf ' . $installerDir );
	}
}

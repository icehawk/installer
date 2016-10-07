<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__;

use IceHawk\IceHawk\IceHawk;

require(__DIR__ . '/../vendor/autoload.php');

$config      = new IceHawkConfig();
$delegate    = new IceHawkDelegate();
$application = new IceHawk( $config, $delegate );

$application->init();
$application->handleRequest();

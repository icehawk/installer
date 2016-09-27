<?php declare(strict_types = 1);
/**
 * @author __AUTHOR__
 */

namespace __NS_VENDOR__\__NS_PROJECT__;

use __NS_VENDOR__\__NS_PROJECT__\Application\IceHawkConfig;
use __NS_VENDOR__\__NS_PROJECT__\Application\IceHawkDelegate;
use IceHawk\IceHawk\IceHawk;

$config      = new IceHawkConfig();
$delegate    = new IceHawkDelegate();
$application = new IceHawk( $config, $delegate );

$application->init();
$application->handleRequest();

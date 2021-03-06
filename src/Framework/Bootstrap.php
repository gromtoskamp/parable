<?php
// @codingStandardsIgnoreStart
/**
 * @package     Parable Framework
 * @license     MIT
 * @author      Robin de Graaf <hello@devvoh.com>
 * @copyright   2015-2016, Robin de Graaf, devvoh webdevelopment
 */

/*
 * Define some global values
 */
define('DS', DIRECTORY_SEPARATOR);
define('BASEDIR', realpath(__DIR__ . DS . '..' . DS . '..' . DS . '..' . DS . '..' . DS  . '..'));

/*
 * Set error reporting level
 */
error_reporting(E_ALL);
ini_set('log_errors', '1');
ini_set('display_errors', '1');

/*
 * Attempt to register composer's autoloader, which will be required for components
 */
$autoloadPath = BASEDIR . DS . 'vendor' . DS . 'autoload.php';
require_once($autoloadPath);

/*
 * And load and register the framework's autoloader
 */
$autoloader = \Parable\DI\Container::get(\Parable\Framework\Autoloader::class);
$autoloader->addLocation(BASEDIR . DS . 'app');
$autoloader->register();

if (PHP_SAPI === 'cli') {
    return \Parable\DI\Container::get(\Parable\Cli\App::class);
}
return \Parable\DI\Container::get(\Parable\Framework\App::class);
// @codingStandardsIgnoreEnd

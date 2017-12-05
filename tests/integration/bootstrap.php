<?php

namespace Fulcrum\Extender\Tests\Integration;

if (version_compare(phpversion(), '5.6.0', '<')) {
    die('Whoops, PHP 5.6 or higher is required.');
}

define('FULCRUM_EXTENDER_INTEGRATION_TESTS_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('FULCRUM_EXTENDER_ROOT_DIR', dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR);

$wpDevTestsDir = getenv('WP_TESTS_DIR');

// Travis CI & Vagrant SSH tests directory.
if (empty($wpDevTestsDir)) {
    $wpDevTestsDir = '/tmp/wordpress-tests';
}

// Relative path to Core tests directory.
if (!file_exists($wpDevTestsDir . '/includes/')) {
    $wpDevTestsDir = '../../../../tests/phpunit';
}

if (!file_exists($wpDevTestsDir . '/includes/')) {
    trigger_error('Unable to locate wordpress-tests-lib', E_USER_ERROR); // @codingStandardsIgnoreLine.
}

require_once $wpDevTestsDir . '/includes/bootstrap.php';

/**
 * Time to load Composer's autoloader.
 */
$vendorPath = FULCRUM_EXTENDER_ROOT_DIR . 'vendor' . DIRECTORY_SEPARATOR;
if (!file_exists($vendorPath . 'autoload.php')) {
    die('Whoops, we need Composer before we start running tests.  Please type: `composer install`.');
}
unset($vendorPath, $wpDevTestsDir);

tests_add_filter('plugins_loaded', __NAMESPACE__ . '\manually_load_plugin', 1);
/**
 * Activates this plugin in WordPress so it can be tested.
 *
 * @since 3.1.0
 *
 * @return void
 */
function manually_load_plugin()
{
    require FULCRUM_EXTENDER_INTEGRATION_TESTS_DIR . 'plugin.php';
}

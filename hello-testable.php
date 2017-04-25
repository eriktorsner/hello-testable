<?php
/**
 *
 * @author    Torgesta Technology <info@wpessentials.io>
 * @license   GPL-2.0+
 *
 * @link      https://www.wpessentials.io
 *
 * @copyright 2017 Torgesta Technology
 *
 * @wordpress-plugin
 * Plugin Name:       Hello Testable
 * Plugin URI:        https://www.wpessentials.io/
 * Description:       A testable version of Hello Dolly
 * Version:           0.1.0
 * Author:            Erik Torsner, Torgesta Technology AB
 * Author URI:        https://www.wpessentials.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hello-testable
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    die;
}

helloTestableBootstrap();

/**
 * The main plugin function. Checks php version
 * and initialize our classes
 */
function helloTestableBootstrap()
{
    $pluginVersion = '0.1.0';
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }

    if (version_compare(PHP_VERSION, '5.3.9', '>=')) {
        require_once __DIR__ . '/vendor/autoload.php';

        if (!defined('HELLO_TESTABLE_VERSION')) {
            define('HELLO_TESTABLE_VERSION', $pluginVersion);
        }

        $app = new helloTestable\Pimple\Container();
        $app->register(new helloTestable\RuntimeProvider());
        $helloTestable = $app['helloTestable'];

        add_action('init', array($helloTestable, 'init'));

    } else {
        register_activation_hook(__FILE__, 'hello_testable_php_version_too_low');
    }
}

if (!function_exists('hello_testable_php_version_too_low')) {
    function hello_testable_php_version_too_low()
    {
        die('The <strong>Hello Testable</strong> plugin requires PHP version 5.3.9 or greater.');
    }
}

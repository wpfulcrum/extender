<?php
/**
 * Extender Plugin
 *
 * @package         Extender
 * @author          hellofromTonya
 * @license         MIT
 * @link            https://github.com/wpfulcrum/extender
 *
 * @wordpress-plugin
 * Plugin Name:     Extender Plugin
 * Plugin URI:      https://github.com/wpfulcrum/extender
 * Description:     The Fulcrum Extender module - extending the PHP functionality for arrays and strings + missing WordPress functionality.
 * Version:         3.1.2
 * Author:          hellofromTonya
 * Author URI:      https://github.com/wpfulcrum/extender
 * Text Domain:     fulcrum
 * Requires WP:     4.5
 * Requires PHP:    5.4
 */

namespace Fulcrum\Extender;

require_once FULCRUM_EXTENDER_ROOT_DIR . 'vendor/autoload.php';
autoloadWPFiles();

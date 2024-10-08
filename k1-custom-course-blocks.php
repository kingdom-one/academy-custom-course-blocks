<?php
/**
 * Plugin Name: K1 Custom Course Blocks
 * Plugin URI: https://github.com/kingdom-one/academy-custom-course-blocks
 * Description: A set of read-only Custom Blocks to extend Lifter LMS for K1 Academy with Advanced Custom Fields Pro.
 * Version: 1.0.2
 * Author: Kingdom One
 * Author URI: http://www.kingdomone.co
 * Text Domain: k1-academy
 * License: GPL-3.0-or-later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Requires at least: 6.6.0
 * Requires PHP: 8.1
 * Tested up to: 6.6.2
 * Requires Plugins: lifterlms,advanced-custom-fields-pro
 *
 * @package K1_Academy
 */

use K1_Academy\Plugin_Loader;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

require_once __DIR__ . '/includes/class-plugin-loader.php';
$plugin_loader = new Plugin_Loader();

register_activation_hook( __FILE__, array( $plugin_loader, 'activate' ) );
register_deactivation_hook( __FILE__, array( $plugin_loader, 'deactivate' ) );

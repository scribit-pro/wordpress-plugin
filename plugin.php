<?php
/**
 * Plugin Name:       Scribit.pro
 * Plugin URI:        https://github.com/scribit-pro/wordpress-plugin
 * Description:       Online video from your WordPress site accessible to all.
 * Version:           0.1
 * Requires at least: 5.9
 * Requires PHP:      8.0
 * Author:            scribit.pro
 * Author URI:        https://scribit.pro
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       scribit
 *
 * @package scribit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

DEFINE( 'SCRIBIT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
const SCRIBIT_TEMPLATE_PATH = SCRIBIT_PLUGIN_PATH . 'assets' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;

require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

add_action( 'admin_init', static fn() => Scribit\WordPress\Hooks\AdminInit::register_plugin_settings() );
add_action( 'admin_menu', static fn() => Scribit\WordPress\Hooks\AdminMenu::register_options_page() );
add_filter( 'oembed_dataparse', static fn( string $html, $data) => Scribit\WordPress\Hooks\OembedDataparse::enable_jsapi_on_youtube( $html, $data ), 15, 2 );

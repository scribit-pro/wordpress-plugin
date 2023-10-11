<?php
/**
 * Plugin Name:       Scribit.Pro
 * Plugin URI:        https://github.com/scribit-pro/wordpress-plugin
 * Description:       Online video from your WordPress site accessible to all.
 * Version:           1.0.2
 * Requires at least: 5.9
 * Requires PHP:      8.0
 * Author:            Scribit.Pro
 * Author URI:        https://scribit.pro
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       scribit
 *
 * @package scribit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

const SCRIBIT_PLUGIN_VERSION = 1.0; // used for asset version caching.

DEFINE( 'SCRIBIT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
require_once SCRIBIT_PLUGIN_PATH . 'vendor/autoload.php';

load_plugin_textdomain( 'scribit', false, SCRIBIT_PLUGIN_PATH . 'languages' );
add_action( 'admin_init', static fn() => Scribit\WordPress\Hooks\AdminInit::register_plugin_settings() );
add_action( 'admin_menu', static fn() => Scribit\WordPress\Hooks\AdminMenu::register_options_page() );
add_action( 'wp_enqueue_scripts', static fn() => Scribit\WordPress\Hooks\EnqueueScripts::load_widget_js() );
add_filter( 'oembed_dataparse', static fn( string $html, $data ) => Scribit\WordPress\Hooks\OembedDataparse::enable_jsapi_on_youtube( $html, $data ), 15, 2 );
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), static fn( array $actions) => Scribit\WordPress\Hooks\PluginActionLinks::add_settings_link( $actions ), 15, 1 );

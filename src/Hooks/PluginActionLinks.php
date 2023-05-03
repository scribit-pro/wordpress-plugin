<?php

declare( strict_types=1 );

namespace Scribit\WordPress\Hooks;

/**
 * This action is used to add extra links to the plugin in the /wp-admin/plugins.php list
 * We use this static class as a single point where we hook into `plugin_action_links_{$plugin_file}`
 *
 * @see https://developer.wordpress.org/reference/hooks/plugin_action_links_plugin_file/
 */
class PluginActionLinks {


	public static function add_settings_link( array $plugin_actions ): array {
		/* translators: link to the plugin settings page when you are browsing the installed WordPress plugins   */
		$text                       = __( '<a href="%s">Settings</a>', 'scribit' );
		$link                       = esc_url( admin_url( 'options-general.php?page=scribit-pro' ) );
		$plugin_actions['settings'] = sprintf( $text, $link );
		return $plugin_actions;
	}
}



<?php

declare( strict_types=1 );

namespace Scribit\WordPress\Hooks;

use Scribit\WordPress\Settings\ScribitID;
use Scribit\WordPress\Settings\WidgetWrapper;
use Scribit\WordPress\Settings\Setting;

/**
 * Fires as an admin screen or script is being initialized. Another typical usage is to register a new setting for use by a plugin.
 * We use this static class as a single point where we hook into `admin_init`
 *
 * @see https://developer.wordpress.org/reference/hooks/admin_init/
 */
class AdminInit {


	public const OPTIONS_GROUP_NAME = 'scribit';

	public static function register_plugin_settings(): void {
		/**
	* @var array<Setting> $fields all settings
*/
		$fields = array( new ScribitID(), new WidgetWrapper() );

		foreach ( $fields as $field ) {
			register_setting(
				self::OPTIONS_GROUP_NAME,
				$field->key(),
				array(
					'sanitize_callback' => array(
						$field,
						'validation_callback',
					),
				)
			);
		}
	}
}



<?php

declare(strict_types=1);

namespace Scribit\WordPress\Hooks;

/**
 * This action is used to add extra submenus and menu options to the admin panel’s menu structure. It runs after the basic admin panel menu structure is in place.
 * We use this static class as a single point where we hook into `admin_menu`
 *
 * @see https://developer.wordpress.org/reference/hooks/admin_menu/
 */
class AdminMenu {



	public static function register_options_page(): void {
		add_submenu_page(
			'options-general.php',
			'Scribit.Pro options',
			'Scribit.Pro',
			'manage_options', // see https://wordpress.org/documentation/article/roles-and-capabilities/#manage_options .
			'scribit-pro',
			static fn() => load_template( SCRIBIT_PLUGIN_PATH . 'assets' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'options.php' )
		);
	}
}



<?php

declare( strict_types=1 );

namespace Scribit\WordPress\Hooks;

use Scribit\WordPress\Settings\ScribitID;
use Scribit\WordPress\Settings\WidgetWrapper;

/**
 * The `wp_enqueue_scripts` is the proper hook to use when enqueuing scripts and styles that are meant to appear on the front end.
 * Despite the name, it is used for enqueuing both scripts and styles.
 *
 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
 */
class EnqueueScripts {


	public const WIDGET_SCRIPT_HANDLE = 'scribit-widget';
	private const WIDGET_CODE         = <<<EOD
    (function(s, w, i, d, g, e, t) {
        s['initScribitWidget'] = function(){s['scribitWidget']=new s.scribit.widget(g, SC_OPTIONS)};
        e = w.createElement(i); e.type='text/javascript'; e.src=d; e.defer=true;
        t = w.getElementsByTagName(i)[0]; t.parentNode.insertBefore(e, t);
    })(window, document, 'script', '//widget.scribit.pro/main.js', 'SC_ID');
EOD;

	public static function load_widget_js(): void {
		wp_register_script( self::WIDGET_SCRIPT_HANDLE, '', null, SCRIBIT_PLUGIN_VERSION, true );

		// We only enqueue the script when the plugin is configured.
		$id = ( new ScribitID() )->value();
		if ( empty( $id ) ) {
			return;
		}

		$options = '{}';
		$wrapper = ( new WidgetWrapper() )->value();
		if ( ! is_null( $wrapper ) ) {
			$options = wp_json_encode( array( 'wrapper' => $wrapper ) );
		}

		$code = str_replace( 'SC_ID', $id, self::WIDGET_CODE );
		$code = str_replace( 'SC_OPTIONS', $options, $code );

		wp_add_inline_script( self::WIDGET_SCRIPT_HANDLE, $code );
		wp_enqueue_script( self::WIDGET_SCRIPT_HANDLE );
	}
}



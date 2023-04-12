<?php

declare( strict_types=1 );

namespace Scribit\WordPress\Hooks;

use Scribit\WordPress\Settings\ScribitID;

/**
 * wp_enqueue_scripts is the proper hook to use when enqueuing scripts and styles that are meant to appear on the front end.
 * Despite the name, it is used for enqueuing both scripts and styles.
 *
 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
 */
class EnqueueScripts {

	const WIDGET_CODE = <<<EOD
    (function(s, w, i, d, g, e, t) {
        s['initScribitWidget'] = function(){s['scribitWidget']=new s.scribit.widget(g, {'wrapper': 'div'})};
        e = w.createElement(i); e.type='text/javascript'; e.src=d; e.defer=true;
        t = w.getElementsByTagName(i)[0]; t.parentNode.insertBefore(e, t);
    })(window, document, 'script', '//widget.scribit.pro/main.js', 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx');
EOD;

	public static function load_widget_js(): void {
		$id = ( new ScribitID() )->value();
		// no need to load any JS when your scribit ID is not configured
		if ( empty( $id ) ) {
			return;
		}

		wp_register_script( 'scribit-widget', '', null, PLUGIN_VERSION, true );
		wp_enqueue_script( 'scribit-widget' );
		wp_add_inline_script( 'scribit-widget', str_replace( 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx', $id, self::WIDGET_CODE ) );
	}
}


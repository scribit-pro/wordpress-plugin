<?php

declare( strict_types=1 );

namespace Scribit\WordPress\Hooks;

use Scribit\WordPress\IframeReplacers\Dom;
use Scribit\WordPress\IframeReplacers\Regex;

/**
 * Filters the returned oEmbed HTML.
 * We use this static class as a single point where we hook into `oembed_dataparse`
 *
 * @see https://developer.wordpress.org/reference/hooks/oembed_dataparse/
 */
class OembedDataparse {


	/**
	 * For our widget to work with YouTube, we'll have to embed YouTube videos with the `enablejsapi` query string so our widget
	 * can read the playback state and ensure the audio descriptions track is synced when watching the video.
	 *
	 * Standard YouTube Oembed responses do not have the enablejsapi enabled and there is no known flag
	 * available to enable this. So our most non-invasive option is to mutate the oembed html response.
	 *
	 * @param string $html Existing HTML.
	 * @param object $data Data object from WP_oEmbed::data2html().
	 *
	 * @return string Possibly modified $html
	 */
	public static function enable_jsapi_on_youtube( string $html, object $data ): string {
		// We're assuming that YouTube oembed will keep on returning the optional "provider_name" key.
		// Matching the provider_name is a lot easier than doing string comparisons on the URL.
		if ( ! isset( $data->provider_name ) || strcasecmp( $data->provider_name, 'YouTube' ) !== 0 ) {
			return $html;
		}

		$adapter = new Regex( $html );
		if ( extension_loaded( 'dom' ) ) {
			$adapter = new Dom( $html );
		}

		$src = $adapter->get_src();
		if ( empty( $src ) ) { // if the strategy fails to find the src, we'll return the original html.
			return $html;
		}

		if ( wp_parse_url( $src, PHP_URL_QUERY ) ) {
			return $adapter->replace_src( $src . '&enablejsapi=1&playsinline=1&disablekb=1' );
		}

		return $adapter->replace_src( $src . '?enablejsapi=1&playsinline=1&disablekb=1' );
	}
}



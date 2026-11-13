<?php

declare( strict_types=1 );

namespace Scribit\WordPress\Hooks;

use Scribit\WordPress\Settings\IframeTitlePrefix;

/**
 * Filters the title attribute of the given oEmbed HTML iframe.
 * We use this static class as a single point where we hook into `oembed_iframe_title_attribute`
 *
 * @see https://developer.wordpress.org/reference/hooks/oembed_iframe_title_attribute/
 */
class OembedIframeTitleAttribute {

	private const PLATFORMS = array(
		'youtube' => 'YouTube',
		'vimeo'   => 'Vimeo',
	);

	/**
	 * Prefixes the iframe title so screen reader users know which video platform they're entering.
	 * For example: "My video" becomes "YouTube video: My video". WordPress core writes and escapes the attribute.
	 *
	 * @param string $title The title attribute.
	 * @param object $data  Data object from the oEmbed provider.
	 *
	 * @return string Possibly prefixed $title
	 */
	public static function prefix_with_platform( string $title, object $data ): string {
		$platform = self::PLATFORMS[ strtolower( $data->provider_name ?? '' ) ] ?? null;
		if ( '' === $title || null === $platform || ! ( new IframeTitlePrefix() )->value() ) {
			return $title;
		}

		/* translators: 1: video platform name, e.g. YouTube. 2: original title of the embedded video */
		return sprintf( __( '%1$s video: %2$s', 'scribit' ), $platform, $title );
	}
}

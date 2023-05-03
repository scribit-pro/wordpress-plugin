<?php

declare( strict_types=1 );

namespace Scribit\WordPress\IframeReplacers;

/**
 * Finds and replaces the SRC attribute of an iframe using Regular expressions
 */
class Regex implements Replacer {


	const REGEX = '/<iframe[^>].*?src=[\'"](.*?)[\'"].*?>.*?<\/iframe>/is';
	/**
	 * The input HTML string
	 *
	 * @var string
	 */
	private string $html;

	public function __construct( string $html ) {
		$this->html = $html;
	}

	public function get_src(): ?string {
		if ( ! preg_match( self::REGEX, $this->html, $matches ) ) {
			return null;
		}

		if ( ! array_key_exists( 1, $matches ) ) {
			return null;
		}

		return $matches[1];
	}

	public function replace_src( string $src ): string {
		return str_replace( $this->get_src(), $src, $this->html );
	}
}



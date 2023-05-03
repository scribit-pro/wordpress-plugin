<?php

declare( strict_types=1 );

namespace Scribit\WordPress\IframeReplacers;

use DOMDocument;
use DOMElement;
use DOMNode;

/**
 * Finds and replaces the SRC attribute of an iframe using PHP's DOM extension
 */
class Dom implements Replacer {


	/**
	 * The input HTML parsed as a DOMDocument
	 *
	 * @var DOMDocument
	 */
	private DOMDocument $parsed;

	public function __construct( string $html ) {
		$this->parsed = new DOMDocument();
		$this->parsed->loadHTML( $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
	}

	private function find_iframe(): ?DOMNode {
		return $this->parsed->getElementsByTagName( 'iframe' )->item( 0 );
	}

	public function get_src(): ?string {
		$iframe = $this->find_iframe();
		if ( ! $iframe instanceof DOMElement ) {
			return null;
		}

		$value = $iframe->getAttribute( 'src' );

		return empty( $value ) ? null : $value;
	}

	public function replace_src( string $src ): string {
		$iframe = $this->find_iframe();
		if ( $iframe instanceof DOMElement ) {
			$iframe->setAttribute( 'src', $src );
		}

		return $this->parsed->saveHTML();
	}
}



<?php

declare( strict_types=1 );

namespace Scribit\WordPress\Settings;

/**
 * IframeTitlePrefix controls whether embedded iframe titles get prefixed with the provider name.
 *
 * Screen reader users navigate by iframe titles. "Scribit Pro Introduction" does not tell them they're about to
 * enter a YouTube player, "YouTube video: Scribit Pro Introduction" does.
 */
class IframeTitlePrefix implements Setting {

	private const KEY = 'scribit_iframe_title_prefix';

	public function key(): string {
		return $this::KEY;
	}

	public function value(): bool {
		return (bool) get_option( $this->key(), false );
	}

	public function validation_callback( mixed $value ): mixed {
		// Unchecked checkboxes are not submitted, so anything but a truthy value means disabled.
		return (bool) $value;
	}
}

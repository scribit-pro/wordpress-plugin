<?php

declare( strict_types=1 );

namespace Scribit\WordPress\Settings;

/**
 * ScribitID is a setting field class for storing and saving your Scirbit ID.
 * Your Scribit ID is a unique identifier we use to communicate with Scribit.Pro
 */
class ScribitID implements Setting {

	private const KEY = 'scribit_id';

	public function key(): string {
		return $this::KEY;
	}

	public function value(): ?string {
		return get_option( $this->key(), null );
	}

	public function validation_callback( mixed $value ): mixed {
		$value = $this->sanitize( $value );
		if ( ! wp_is_uuid( $value, 4 ) ) {
			add_settings_error( $this->key(), 'invalidUUID', 'Given ID is not a valid Scribit ID' );

			return $this->value();
		}

		return $value;
	}

	private function sanitize( mixed $input ): ?string {
		if ( is_array( $input ) || is_object( $input ) || is_numeric( $input ) || empty( $input ) ) {
			return null;
		}

		return sanitize_text_field( $input );
	}
}



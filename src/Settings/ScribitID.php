<?php

declare(strict_types=1);

namespace Scribit\WordPress\Settings;

/**
 * ScribitID is a setting field class for storing and saving your Scirbit ID.
 * Your Scribit ID is a unique identifier we use to communicate with scribit.pro
 */
class ScribitID {

	/**
	 * The unique wp_options key this setting is stored in
	 *
	 * @var string
	 */
	public string $key;

	public function __construct() {
		$this->key = 'scribit_id';
	}

	public function sanitize( string $input ): string {
		return sanitize_text_field( $input );
	}

	public function label(): ?string {
		return __( 'your Scribit.Pro ID' );
	}
	public function value(): ?string {
		return get_option( $this->key );
	}

	/**
	 * WordPress calls this function to resolve what it should "update" in the db.
	 * So note that we'll return the current get_option whenever validation fails.
	 *
	 * @param string $input the given value the user or machine is trying to save
	 */
	public function validate( string $input ): ?string {
		$input = $this->sanitize( $input );
		if ( ! wp_is_uuid( $input, 4 ) ) {
			add_settings_error( $this->key, 'invalidUUID', 'Given ID is not a valid Scribit ID' );
			return $this->value();
		}

		return $input;
	}
}



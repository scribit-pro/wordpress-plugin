<?php

declare( strict_types=1 );

namespace Scribit\WordPress\Settings;

interface Setting {


	/**
	 * The element and wp_options key this setting is controlling
	 *
	 * @return string
	 */
	public function key(): string;

	/**
	 * The value persisted in your wp_options
	 *
	 * @return mixed
	 */
	public function value(): mixed;

	/**
	 * The callback function that WordPress calls when deciding what to save in the
	 * DB.
	 *
	 * @param mixed $value
	 */
	public function validation_callback( mixed $value ): mixed;

}



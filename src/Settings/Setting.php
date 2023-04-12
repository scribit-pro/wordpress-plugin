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
	 *
	 * The callback function you can call when you want to change the value
	 *
	 * @param mixed $value
	 */
	public function validate_and_save( mixed $value ): mixed;

}



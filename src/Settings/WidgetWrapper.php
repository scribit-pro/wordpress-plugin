<?php

declare( strict_types=1 );

namespace Scribit\WordPress\Settings;

/**
 * WidgetWrapper is a configuration argument for the widget itself. It allows you to control where the widget wil inject the "toolbar".
 *
 * Modern responsive websites will wrap the embed in a div that ensures the embedded video is scaled properly.
 * This is super neat but often involves an assumption around the aspect ratio of the video.
 * When we inject our widget beneath the video's iframe, this aspect ratio assumption is no longer valid and thus
 * the widget toolbar is then "hidden behind the embedded content". You (the web developer) can easily fix that by
 * adding an argument to our widget code, instructing it to inject itself one parent above the embedded content.
 */
class WidgetWrapper implements Setting {

	private const KEY = 'scrbit_widget_wrapper';

	public function options(): array {
		return array(
			null, // no wrapper target.
			'div', // insert after first parent `div` element.
		);
	}

	public function key(): string {
		return $this::KEY;
	}

	public function value(): ?string {
		return get_option( $this->key(), 'div' );
	}

	public function validation_callback( mixed $value ): mixed {
		$value = $this->sanitize( $value );
		if ( ! in_array( $value, $this->options(), true ) ) {
			add_settings_error( $this->key(), 'invalidOption', 'Selected placement option is not valid' );

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



<?php

namespace tests\Settings;

use Scribit\WordPress\Settings\ScribitID;

class TestScribitID extends \WP_UnitTestCase {

	protected $subject;

	public function setUp(): void {
		$this->subject = new ScribitID();

		// (re) set any flash error messages
		global $wp_settings_errors;
		$wp_settings_errors = [];
	}


	/**
	 * @dataProvider invalidValues
	 */
	public function testHandlesMixedInvalidValues( mixed $value ) {
		$this->assertNull( $this->subject->validation_callback( $value ) );
		$this->assertNotEmpty( get_settings_errors( $this->subject->key() ) );
	}

	public function testHandlesValidValue() {
		$value = '74b1c6e3-9e5f-4229-8e46-1bc4dd43eb2e';

		$this->assertEquals( $value, $this->subject->validation_callback( $value ) );
		$this->assertEmpty( get_settings_errors( $this->subject->key() ) );
	}

	public function invalidValues(): array {
		return [
			[ null ],
			[ false ],
			[ true ],
			[ 1 ],
			[ "one" ],
			[ "" ],
			[ "9914fccc-d929-11ed-afa1-0242ac120002" ],
			[ [] ],
			[ (object) array( 'foo' => 'bar' ) ]
		];
	}
}

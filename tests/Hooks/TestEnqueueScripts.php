<?php


use Scribit\WordPress\Hooks\EnqueueScripts;
use Scribit\WordPress\Settings\ScribitID;

class TestEnqueueScripts extends \WP_UnitTestCase {

	public function testRegistersScript() {
		delete_option( ( new ScribitID() )->key() );

		EnqueueScripts::load_widget_js();

		$this->assertTrue( wp_script_is( EnqueueScripts::WIDGET_SCRIPT_HANDLE, 'registered' ) );
	}

	public function testEnqueuesScriptWhenScribitIDIsConfigured() {
		update_option( ( new ScribitID() )->key(), wp_generate_uuid4() );

		EnqueueScripts::load_widget_js();

		$this->assertTrue( wp_script_is( EnqueueScripts::WIDGET_SCRIPT_HANDLE, 'enqueued' ) );
	}
}

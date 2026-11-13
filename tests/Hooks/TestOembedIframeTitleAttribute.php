<?php


use Scribit\WordPress\Hooks\OembedIframeTitleAttribute;
use Scribit\WordPress\Settings\IframeTitlePrefix;

class TestOembedIframeTitleAttribute extends \WP_UnitTestCase {

	private const YOUTUBE = array( 'provider_name' => 'YouTube' );

	public function testPrefixesYouTubeAndVimeoTitlesWhenEnabled() {
		update_option( ( new IframeTitlePrefix() )->key(), true );

		$this->assertSame( 'YouTube video: Scribit Pro Introduction in English', OembedIframeTitleAttribute::prefix_with_platform( 'Scribit Pro Introduction in English', (object) self::YOUTUBE ) );
		$this->assertSame( 'Vimeo video: The New Vimeo Player', OembedIframeTitleAttribute::prefix_with_platform( 'The New Vimeo Player', (object) array( 'provider_name' => 'Vimeo' ) ) );
	}

	public function testLeavesTitleUntouchedWhenDisabled() {
		delete_option( ( new IframeTitlePrefix() )->key() );

		$this->assertSame( 'My video', OembedIframeTitleAttribute::prefix_with_platform( 'My video', (object) self::YOUTUBE ) );
	}

	public function testLeavesOtherPlatformsAndEmptyTitlesUntouched() {
		update_option( ( new IframeTitlePrefix() )->key(), true );

		$this->assertSame( 'My video', OembedIframeTitleAttribute::prefix_with_platform( 'My video', (object) array( 'provider_name' => 'Dailymotion' ) ) );
		$this->assertSame( 'My video', OembedIframeTitleAttribute::prefix_with_platform( 'My video', (object) array() ) );
		$this->assertSame( '', OembedIframeTitleAttribute::prefix_with_platform( '', (object) self::YOUTUBE ) );
	}

	public function testPrefixEndsUpInEmbedHtml() {
		update_option( ( new IframeTitlePrefix() )->key(), true );

		$html = '<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/13OQlqXz0w8" title="Scribit Pro Introduction in English" allowfullscreen></iframe>';
		$data = (object) array(
			'provider_name' => 'YouTube',
			'type'          => 'video',
		);

		$this->assertStringContainsString( 'title="YouTube video: Scribit Pro Introduction in English"', wp_filter_oembed_iframe_title_attribute( $html, $data, '' ) );
	}
}

<?php

declare( strict_types=1 );

namespace Scribit\WordPress\IframeReplacers;

interface Replacer {


	public function __construct( string $html );

	public function get_src(): ?string;

	public function replace_src( string $src ): string;
}



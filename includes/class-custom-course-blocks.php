<?php
/**
 * Custom Course Blocks
 * Registers custom course blocks for use in the block editor.
 *
 * @package KingdomOne
 */

namespace KingdomOne\ACF;

/**
 * Custom_Course_Blocks
 */
class Custom_Course_Blocks {
	public function __construct() {
		add_action( 'init', array( $this, 'register_blocks' ) );
	}

	public function register_blocks() {
		$block_path = dirname( __DIR__, 1 ) . '/blocks';
		$blocks     = array(
			'course-features',
			'course-description',
			'course-price',
		);
		foreach ( $blocks as $block ) {
			register_block_type( "{$block_path}/{$block}" );
		}
	}
}

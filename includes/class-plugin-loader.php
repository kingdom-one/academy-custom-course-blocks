<?php
/**
 * Plugin Loader
 *
 * @package K1_Academy
 */

namespace K1_Academy;

/** Inits the Plugin */
class Plugin_Loader {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_blocks' ) );
	}

	/**
	 * Registers the Custom Blocks
	 *
	 * @return void
	 */
	public function register_blocks(): void {
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

	/**
	 * Initializes the Plugin
	 *
	 * @return void
	 */
	public function activate(): void {
		flush_rewrite_rules();
	}

	/**
	 * Handles Plugin Deactivation
	 * (this is a callback function for the `register_deactivation_hook` function)
	 *
	 * @return void
	 */
	public function deactivate(): void {
		flush_rewrite_rules();
	}
}

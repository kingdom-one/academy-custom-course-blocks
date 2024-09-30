<?php
/**
 * Plugin Loader
 *
 * @package K1_Academy
 */

namespace K1_Academy;

use Exception;

/** Inits the Plugin */
class Plugin_Loader {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_blocks' ) );
		add_action( 'rest_api_init', array( $this, 'register_post_meta_fields' ) );
	}

	/**
	 * Registers the Custom Blocks
	 *
	 * @return void
	 * @throws Exception If block registration fails.
	 */
	public function register_blocks(): void {
		$block_path = dirname( __DIR__, 1 ) . '/build';
		$blocks     = array(
			'course-features',
			'course-description',
			'course-price',
		);
		foreach ( $blocks as $block ) {
			$path = "{$block_path}/{$block}/{$block}.php";
			$x    = register_block_type( "{$block_path}/{$block}" );
			if ( false === $x ) {
				throw new Exception( esc_textarea( "Failed to register block: {$block}" ) );
			}
		}
	}

	/**
	 * Registers the Post Meta Fields to the Lifter Course Post Type
	 *
	 * @return void
	 */
	public function register_post_meta_fields(): void {
		$lifter_post_type = 'course';
		$meta_keys        = array(
			'course_description' => 'string',
			'course_price'       => 'string',
			'course_features'    => 'array',
		);
		foreach ( $meta_keys as $meta_key => $type ) {
			register_post_meta(
				$lifter_post_type,
				$meta_key,
				array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => $type,
				)
			);
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

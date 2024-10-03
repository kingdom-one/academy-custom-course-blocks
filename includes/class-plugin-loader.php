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
	 * The Namespace blocks are registered under
	 *
	 * @var string $block_namespace
	 */
	private string $block_namespace;

	/**
	 * The Block names to Register
	 *
	 * @var string[] $blocks
	 */
	private array $blocks;
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->load_required_files();
		$this->block_namespace = 'k1-academy';
		$this->blocks          = array(
			'course-features',
			'course-description',
			'course-price',
		);
		add_action( 'init', array( $this, 'register_blocks' ) );
		add_filter( 'allowed_block_types_all', array( $this, 'disallow_blocks' ), 10, 2 );
	}

	/**
	 * Loads the Required Files and instantiates them.
	 *
	 * @return void
	 */
	private function load_required_files(): void {
		$base_path = dirname( __DIR__, 1 ) . '/includes';
		$files     = array(
			'acf-loader' => array(
				'class'     => 'ACF_Loader',
				'namespace' => 'ACF',
			),
		);
		foreach ( $files as $file => $data ) {
			require_once "{$base_path}/class-{$file}.php";
			$class = __NAMESPACE__ . "\\{$data['namespace']}\\{$data['class']}";
			new $class();
		}
	}

	/**
	 * Registers the Custom Blocks
	 *
	 * @return void
	 * @throws Exception If block registration fails.
	 */
	public function register_blocks(): void {
		$block_path = dirname( __DIR__, 1 ) . '/build';
		foreach ( $this->blocks as $block ) {
			$x = register_block_type( "{$block_path}/{$block}" );
			if ( false === $x ) {
				throw new Exception( esc_textarea( "Failed to register block: {$block}" ) );
			}
		}
	}

	/**
	 * Disallows Blocks
	 *
	 * @param array|bool $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
	 * @param object     $block_editor_context The current block editor context.
	 * @return array
	 */
	public function disallow_blocks( array|bool $allowed_block_types, object $block_editor_context ): array {
		if ( isset( $block_editor_context->post ) &&
		'course' !== $block_editor_context->post->post_type ) {
			return $allowed_block_types;
		}

		// Create an array of disallowed blocks.
		$disallowed_blocks = array_map(
			fn( $block ) => "{$this->block_namespace}/{$block}",
			$this->blocks
		);
		// Get all registered blocks if $allowed_block_types is not already set.
		if ( ! is_array( $allowed_block_types ) || empty( $allowed_block_types ) ) {
			$registered_blocks   = \WP_Block_Type_Registry::get_instance()->get_all_registered();
			$allowed_block_types = array_keys( $registered_blocks );
		}

		// Create a new array for the allowed blocks.
		$filtered_blocks = array();

		// Loop through each block in the allowed blocks list.
		foreach ( $allowed_block_types as $block ) {

			// Check if the block is not in the disallowed blocks list.
			if ( ! in_array( $block, $disallowed_blocks, true ) ) {

				// If it's not disallowed, add it to the filtered list.
				$filtered_blocks[] = $block;
			}
		}

		// Return the filtered list of allowed blocks
		return $filtered_blocks;
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

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
		add_filter( 'block_categories_all', array( $this, 'add_block_category' ) );
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
	 * Adds a Custom Block Category
	 *
	 * @param array $categories The existing block categories.
	 * @return array
	 */
	public function add_block_category( array $categories ): array {
		$categories[] = array(
			'slug'  => 'k1-custom-course-blocks',
			'title' => 'Kingdom One Course Blocks',
		);
		return $categories;
	}

	/**
	 * Hides custom course blocks if the post type is not 'course'.
	 *
	 * @param array|bool $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
	 * @param object     $block_editor_context The current block editor context.
	 * @return array
	 */
	public function disallow_blocks( array|bool $allowed_block_types, object $block_editor_context ): array|bool {
		if ( isset( $block_editor_context->post ) &&
		'course' === $block_editor_context->post->post_type ) {
			return $allowed_block_types;
		}

		// Create an array of disallowed blocks.
		$block_to_hide = array_map(
			fn( $block ) => "{$this->block_namespace}/{$block}",
			$this->blocks
		);

		// Get all registered blocks if $allowed_block_types is not already set.
		if ( ! is_array( $allowed_block_types ) || empty( $allowed_block_types ) ) {
			$registered_blocks   = \WP_Block_Type_Registry::get_instance()->get_all_registered();
			$allowed_block_types = array_keys( $registered_blocks );
		}

		// Filter out the blocks we want to hide.
		$filtered_blocks = array_filter(
			$allowed_block_types,
			fn( $block ) => ! in_array( $block, $block_to_hide, true )
		);

		// Return the list of allowed blocks
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

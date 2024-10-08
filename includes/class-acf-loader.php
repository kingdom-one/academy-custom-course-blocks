<?php
/**
 * ACF Loader
 * Loads specific ACF fields for the K1 Custom Course Blocks plugin
 *
 * @package K1_Academy
 * @subpackage ACF
 */

namespace K1_Academy\ACF;

/**
 * ACF Loader
 */
class ACF_Loader {
	/**
	 * ACF_Loader constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_fields' ) );
	}

	/**
	 * Register ACF Fields
	 *
	 * @return void
	 */
	public function register_fields() {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group(
			array(
				'key'                   => 'group_66f1a226cc103',
				'title'                 => 'Post Type — Courses',
				'fields'                => array(
					array(
						'key'                => 'field_66f1a33520469',
						'label'              => 'Course Features',
						'name'               => 'course_features',
						'aria-label'         => '',
						'type'               => 'repeater',
						'instructions'       => 'Used in some marketing layouts to show an overview of course features',
						'required'           => 0,
						'conditional_logic'  => 0,
						'wrapper'            => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'relevanssi_exclude' => 0,
						'layout'             => 'table',
						'pagination'         => 0,
						'min'                => 0,
						'max'                => 0,
						'collapsed'          => '',
						'button_label'       => 'Add Feature',
						'rows_per_page'      => 20,
						'sub_fields'         => array(
							array(
								'key'                => 'field_66f1a3412046a',
								'label'              => 'Feature',
								'name'               => 'feature',
								'aria-label'         => '',
								'type'               => 'text',
								'instructions'       => '',
								'required'           => 0,
								'conditional_logic'  => 0,
								'wrapper'            => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'relevanssi_exclude' => 0,
								'default_value'      => '',
								'maxlength'          => '',
								'placeholder'        => '',
								'prepend'            => '',
								'append'             => '',
								'parent_repeater'    => 'field_66f1a33520469',
							),
						),
					),
					array(
						'key'                => 'field_66fe1145b2751',
						'label'              => 'Course Description',
						'name'               => 'course_description',
						'aria-label'         => '',
						'type'               => 'wysiwyg',
						'instructions'       => '',
						'required'           => 0,
						'conditional_logic'  => 0,
						'wrapper'            => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'relevanssi_exclude' => 0,
						'default_value'      => '',
						'allow_in_bindings'  => 0,
						'tabs'               => 'all',
						'toolbar'            => 'full',
						'media_upload'       => 0,
						'delay'              => 0,
					),
					array(
						'key'                => 'field_66fe1193b2752',
						'label'              => 'Course Price',
						'name'               => 'course_price',
						'aria-label'         => '',
						'type'               => 'text',
						'instructions'       => 'A simple course price used in various places for marketing (e.g. $10/user)',
						'required'           => 0,
						'conditional_logic'  => 0,
						'wrapper'            => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'relevanssi_exclude' => 0,
						'default_value'      => '',
						'maxlength'          => '',
						'allow_in_bindings'  => 0,
						'placeholder'        => '',
						'prepend'            => '',
						'append'             => '',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'course',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 1,
			)
		);
	}
}

<?php
/**
 * The Course Description block.
 *
 * @package KingdomOne
 * @subpackage ACF
 */

echo get_post_meta( get_the_ID(), 'course_features', true );
var_dump( $content );

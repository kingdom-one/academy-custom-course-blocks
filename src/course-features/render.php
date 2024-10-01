<?php
/**
 * The Course Description block.
 *
 * @package KingdomOne
 * @subpackage ACF
 */

$features = get_post_meta( get_the_ID(), 'course_features' );
var_dump( $features );
var_dump( $attributes['features'] );

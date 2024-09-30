<?php
/**
 * The Course Description block.
 *
 * @package KingdomOne
 * @subpackage ACF
 */

$description = get_post_meta( get_the_ID(), 'course_description', true );
?>
<div class="k1-course-description"><?php echo $description; ?></div>

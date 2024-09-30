<?php
/**
 * The Course Description block.
 *
 * @package KingdomOne
 * @subpackage ACF
 */

$price = get_post_meta( get_the_ID(), 'course_price', true );
?>
<div class="k1-course-price"><strong>Price: </strong> <?php echo $price; ?></div>

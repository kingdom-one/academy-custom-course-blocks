<?php
/**
 * The Course Description block.
 *
 * @package KingdomOne
 * @subpackage ACF
 */

$features = get_field( 'course_features' );
?>
<div class="k1-course-features">
	<p><strong>Course Features:</strong></p>
	<ul>
		<?php
		array_map(
			function ( $feature ) {
				echo "<li>{$feature}</li>";
			},
			$features
		);
		?>
	</ul>
</div>

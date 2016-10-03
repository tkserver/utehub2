<?php

/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums">


<!-- CONTENT-SINGLE-TOPIC.PHP -->

		<?php if ( bbp_has_replies() ) : ?>

			<?php bbp_get_template_part( 'pagination', 'replies' ); ?>

			<?php bbp_get_template_part( 'loop',       'replies' ); ?>

			<?php bbp_get_template_part( 'pagination', 'replies' ); ?>
		<?php endif; ?>


          <a href="#" class="btn btn-default forum-footer" role="button">BACK TO TOP</a>
		<?php bbp_get_template_part( 'form', 'reply' ); ?>


	<?php do_action( 'bbp_template_after_single_topic' ); ?>
	<?php bbp_breadcrumb(); ?>
	<?php bbp_single_topic_description(); ?>



</div>

<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>


<ul id="topic-<?php bbp_topic_id(); ?>-replies" class="forums">


	<li class="bbp-body">

		<?php if ( bbp_thread_replies() ) : ?>

			<?php bbp_list_replies(); ?>

		<?php else : ?>

			<?php while ( bbp_replies() ) : bbp_the_reply(); ?>
				<?php bbp_get_template_part( 'loop', 'single-tkreply' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

	</li><!-- .bbp-body -->


</ul><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

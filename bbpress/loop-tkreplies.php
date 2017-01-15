<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

		<?php if ( bbp_thread_replies() ) : ?>

			<?php tk_list_replies(); ?>

		<?php else : ?>

			<?php while ( bbp_replies() ) : bbp_the_reply(); ?>
				<?php bbp_get_template_part( 'loop', 'single-tkreply' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

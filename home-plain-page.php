<?php
	/**
	 * Template Name: Plain Page Jan 2017
	 * Description: Used as a page template to show page contents, followed by a loop through a topics archive
	 */
	 // Gets header.php
		get_header();
		?>

		<div class="container">
			<div class="row mobileContent browserContent">
				<?php

	global $wp_query, $wpdb;

					$args = array(
						'post_type' => 'topic', // enter your custom post type
						'orderby' => 'date',
						'order' => 'DESC',
						'posts_per_page' => 10,
						'paged' => $paged
					);

			$loop = new WP_Query( $args );

			if( $loop->have_posts() ):

			while( $loop->have_posts() ): $loop->the_post(); global $post;
				$parentID = get_the_ID();
				$topicLink = get_page_link();
				$parent = get_the_ID();
				$parent_title = get_the_title($parent);
				$grandparent_title = get_the_title();
				$author = get_the_author_meta( 'ID' );
				$postLink = get_permalink();
				$categoryLink = get_permalink($parentID);
				$postID = get_the_ID();
				//$menu_order = $post->menu_order;
				$forum_id = get_post_meta( get_the_ID(), '_bbp_forum_id', true);
				$topic_id = get_post_meta( get_the_ID(), '_bbp_topic_id', true);
				$thread_url =  get_site_url() . '?th='.$parentID;
				$forum_title = get_the_title($forum_id);
				$forum_link = get_permalink($forum_id);
				$post_status = get_post_status();
				$user_can_edit = 'no';
				$avatar = get_avatar( get_the_author_meta( 'ID' ), 42 );
				$timestamp = get_post_time('U', true);
?>

<div class="col-xs-12 well">
		<?php echo '<p>'.$parent_title.'</p>'; ?>
		<?php $the_content = apply_filters('the_content', get_the_content()); ?>
		<?php echo $the_content; ?>
		<?php
			$parents_ids   = get_post_ancestors($post->ID);
			$top_parent_id = (count($parents_ids) > 0) ? $parents_ids[count($parents_ids)-1] : $post->ID;
			show_all_children($top_parent_id, $post->ID, 1);
		?>
</div>


	<?php endwhile; ?> <!-- ends the while there is a post loop -->

		<?php endif; ?>
	</div>
</div> <!-- well threadwell -->
		    	<div class="col-sm-12 text-center">
				<?php

		      		$big = 999999999; // need an unlikely integer
				    	$pages = paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				        'format' => '?paged=%#%',
				        'current' => max( 1, get_query_var('page') ),
				        'total' => $loop->max_num_pages,
				        'type'  => 'array',
				      	)
					);

			      	/* below adds bootstrap styling to the paginated links.  Cool beans */
			        	if( is_array( $pages ) ) {
			         		$paged = ( get_query_var('page') == 0 ) ? 1 : get_query_var('page');
			         		echo '<div class="pagination-wrap"><ul class="pagination">';
			         		foreach ( $pages as $page ) {
			           			echo "<li>$page</li>";
			            	}
			            	echo '</ul></div>';
			          }
				?>

				<!--  Outro Text (hard coded)  -->
			</div><!-- end .entry-content -->
		</div><!-- end .page .hentry .entry -->


	    	</div>

	    <div class="col-md-3 col-lg-3">
	    	<?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
	      		<div id="secondary" class="sidebar-container" role="complementary">
	        		<div class="widget-area">
	          			<?php dynamic_sidebar( 'sidebar-6' ); ?>
	        		</div> <!-- .widget-area -->
	      		</div> <!-- #secondary -->
	      	<?php endif; ?>
	    </div>

	</div> <!-- row mobileContent browserContent -->
</div> <!-- containersecondary -->

<?php get_footer(); ?>

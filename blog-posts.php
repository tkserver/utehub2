<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Wp_Bootstrap
 * @since Wp Bootstrap 1.0
 */

	// Gets header.php
	
	/* Template Name: BlogPosts */

	get_header();
	 
	?> 
 	<div class="container-fluid tkContent">
     	<div class="container tkWhite">
      		<div class="row">
  				<div class="col-lg-8 col-xs-12 col-sm-12 col-md-8 well">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                    				<strong>Written by:</strong> <?php the_author_link(); ?> | <strong>Date:</strong> <?php the_time('l, F jS, Y'); ?> 
									<?php edit_post_link(); ?><br />
                        				<strong>Categories:</strong> <?php the_category(' &bull; '); ?><br />
                          					<?php the_tags('<strong>Tags:</strong> ',' • ',''); ?>
                                     	<hr>
                                         	<div class="tkContent">
                                     			<?php the_content(); ?>
                                          	</div>
                                             <hr class="clearBoth">
                                            <?php comments_template(); ?>
                		<?php endwhile; else: ?>
       					<p><?php _e('Sorry, this page does not exist.'); ?></p>
    					<?php endif; ?>
                  </div> <!-- well -->

  				<div class="col-lg-4 col-xs-12 col-sm-12 col-md-4"><?php get_sidebar(); ?> </div>
            </div> <!-- row -->

		</div> <!-- tkWhite -->
          </div>    
                   

<?php

	// Gets footer.php
	get_footer(); 
?>
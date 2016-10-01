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
/* Template Name: Contact Page*/

	// Gets contact.php
			get_header();
	 
	 ?>
    	<div class="container-fluid tkContent">
     	<div class="container tkWhite">


           <!-- /END THE FEATURETTES -->
      	<div class="row">
  		<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 well">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						<?php edit_post_link(); ?>
                                     <hr>
                                     <?php the_content(); ?>
                                     <hr>
                 </div>
                          						<?php endwhile; else: ?>
       		<p><?php _e('Sorry, this page does not exist.'); ?></p>
    	<?php endif; ?>
     </div>
      </div>
      </div>
      </div>
      
      <?php
	 
	// Gets footer.php
	get_footer(); 
?>
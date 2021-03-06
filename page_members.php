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
/* Template Name: Members Page*/

	// Gets page_members.php
	get_header();
	 
	 ?>

<div class="container"> 
  <!-- Example row of columns -->
  <div class="row well containerShadow">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 well well-sm" id="registerContent">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <h1><a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
        </a></h1>
      <?php edit_post_link(); ?>
      <hr>
      <?php the_content(); ?>
      <hr>
    </div>
    <?php endwhile; else: ?>
    <p>
      <?php _e('Sorry, this page does not exist.'); ?>
    </p>
    <?php endif; ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
    		<!-- sidebar-7 also known as MembersRight -->
      	<?php if ( is_active_sidebar( 'sidebar-7' ) ) : ?>
                    <div id="sidebar-7" class="sidebar-container" role="complementary">
                         <div class="widget-area">
                              <?php dynamic_sidebar( 'sidebar-7' ); ?>
                         </div><!-- .widget-area -->
                    </div><!-- #secondary -->
               <?php endif; ?>     
               
               </div>
  </div>
</div>
<?php

	// Gets footer.php
	get_footer(); 
?>

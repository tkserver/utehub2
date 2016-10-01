<!-- begin footer left sidebar -->
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
          <div id="sidebar-2" class="sidebar-container" role="complementary">
               <div class="widget-area">
                    <?php dynamic_sidebar( 'sidebar-2' ); ?>
               </div><!-- .widget-area -->
          </div><!-- #secondary -->
     <?php endif; ?>
 <!-- end footer left sidebar -->
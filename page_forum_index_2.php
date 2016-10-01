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
/* Template Name: Forum Index 2.0 Page*/

	// Gets page_forum_index_2.php
	get_header();
	 
	 ?>

<div class="container"> 
  <!-- Example row of columns -->
  <div class="row well containerShadow">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 well well-sm">
      
 
   
     
     
      <div class="col-sm-12 col-lg-12">

	<h1>Ute Hub Forum Index</h1>
</div>     
      <div class="col-sm-12 col-lg-12 well-square">
      	<div class="indexCategoryThumb"><img src="http://www.utehub.com/wp-content/uploads/2015/10/Utah_Black_Helmet-sm.png"></div>
      		<div class="indexTitle"><h1><a class="indexLink" href="http://www.utehub.com/forums/forum/sports/">Utah Utes Sports</a></h1></div>
          		<div class="indexFooter"><span class="indexPostDetails">
                    	<a  class="indexLink" href="http://www.utehub.com/forums/forum/sports/football/">Football</a> | 
                         <a  class="indexLink" href="http://www.utehub.com/forums/forum/sports/mbb/">Basketball</a> | 
                         <a  class="indexLink" href="http://www.utehub.com/forums/forum/sports/">Other Sports</a> | 
                         <a  class="indexLink" href="http://www.utehub.com/forums/forum/sports/pac12/">Pac-12</a>
                         </span><span class="indexPostLatest"></span></div>
      </div>
            <div class="col-sm-12 col-lg-12 well well-sm well-square">
      	<div class="indexCategoryThumb"><img src="http://www.utehub.com/wp-content/uploads/2015/10/nfl-helmet.png"></div>
      		<div class="indexTitle"><h1><a class="indexLink" href="http://www.utehub.com/forums/forum/professional-sports/">Pro Sports</a></h1></div>
          		<div class="indexFooter"><span class="indexPostDetails">
                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/professional-sports/nfl/">NFL</a> | 
                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/professional-sports/mlb/">MLB</a> | 
                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/professional-sports/nba/">NBA</a> | 
                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/professional-sports/nhl/">NHL</a> | 
                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/professional-sports/">More...</a> | 
                         </span><span class="indexPostLatest"></span></div>
      </div>
            <div class="col-sm-12 col-lg-12 well well-sm well-square">
      	<div class="indexCategoryThumb"><img src="http://www.utehub.com/wp-content/uploads/2015/10/microphone.png"></div>
      		<div class="indexTitle"><h1><a class="indexLink" href="http://www.utehub.com/forums/forum/general-topics/">General Topics</a></h1></div>
          		<div class="indexFooter"><span class="indexPostDetails">
                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/misc/">Misc</a> | 
                         <a class="indexLink" href="http://www.utehub.com/forums/forum/politics/">Politics</a>
                         </span>
                         <span class="indexPostLatest"></span></div>
      </div>
      <div class="col-sm-12 col-lg-12 well well-sm well-square">
      	<div class="indexCategoryThumb"><img src="http://www.utehub.com/wp-content/uploads/2015/10/UteHub-50x50.png"></div>
      		<div class="indexTitle"><h1><a class="indexLink" href="http://www.utehub.com/forums/forum/hubinfo/">Ute Hub Site</a></h1></div>
          		<div class="indexFooter"><span class="indexPostDetails">
                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/ute-hub-site/site-news-discussion/">Comments/Suggestions</a> | 
                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/ute-hub-site/how-to-use-ute-hub/">How To Use Ute Hub</a>
                         </span><span class="indexPostLatest"></span></div>
      </div>
      <div class="col-sm-12 col-lg-12 well well-sm well-square">
      	<div class="indexCategoryThumb"><img src="http://www.utehub.com/wp-content/uploads/2015/10/byu_logo.png"></div>
      		<div class="indexTitle"><h1><a class="indexLink" href="http://www.utehub.com/forums/forum/byutds/">byu/tds</a></h1></div>
          		<div class="indexFooter"><span class="indexPostDetails">
                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/byutds/">Rivalry Smack</a></span><span class="indexPostLatest"></span></div>
      </div>
  </div>
      
      
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
		<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
                    <div id="sidebar-5" class="sidebar-container" role="complementary">
                         <div class="widget-area">
                              <?php dynamic_sidebar( 'sidebar-5' ); ?>
                         </div><!-- .widget-area -->
                    </div><!-- #secondary -->
               <?php endif; ?> 
    </div>
</div>
<?php

	// Gets footer.php
	get_footer(); 
?>

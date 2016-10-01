<?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

	 
	 ?>
      <?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_forums_loop' );


$host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
//echo "host is " . $host;

if($host == 'www.utehub.com/forums/') 
{

?>

<div class="col-sm-12 col-lg-12 well-square">
      	<div class="indexCategoryThumb"><img src="http://www.utehub.com/wp-content/uploads/2015/10/Utah_Black_Helmet-sm.png"></div>
      		<div class="indexTitle"><h1><a class="indexLink" href="http://www.utehub.com/forums/forum/sports/">Utah Utes</a></h1></div>
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
                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/professional-sports/">More...</a>
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
      

<?php

}
else

{
	
	?>

     <ul id="forums-list-<?php bbp_forum_id(); ?>">

	<li class="bbp-header">

		<ul class="forum-titles">
			<li class="bbp-forum-info"><?php _e( 'Forum', 'bbpress' ); ?></li>
			<li class="bbp-forum-topic-count"><?php _e( 'Topics', 'bbpress' ); ?></li>
			<li class="bbp-forum-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></li>
			<li class="bbp-forum-freshness"><?php _e( 'Freshness', 'bbpress' ); ?></li>
		</ul>

	</li><!-- .bbp-header -->

	<li class="bbp-body">

		<?php while ( bbp_forums() ) : bbp_the_forum(); ?>

			<?php bbp_get_template_part( 'loop', 'single-forum' ); ?>

		<?php endwhile; ?>

	</li><!-- .bbp-body -->

	<li class="bbp-footer">

		<div class="tr">
			<p class="td colspan4">&nbsp;</p>
		</div><!-- .tr -->

	</li><!-- .bbp-footer -->

</ul><!-- .forums-directory -->
    
      <?
	 
	 }



?>



     
  

<?php do_action( 'bbp_template_after_forums_loop' ); ?>

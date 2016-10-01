<?php

/**
 * Template Name: Forum Loop
 * Description: Used as a page template to show page contents, followed by a loop through a topics archive  
 */
 // Gets header.php
	get_header();
	 
	?>
 <script>    
     function myFunction() {
    alert("Feature not implemented yet! GO UTES!");
}
</script>

<script>
function open() {
    window.open("http://www.w3schools.com");
}

function openThread () {
	
	window.open("postlink","_self")
	
}
</script>


  <div class="container"> 
  <div class="row well containerShadow">
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 well well-sm" id="registerContent">
      
           <?php


 	// Intro Text (from page content)
	echo '<div class="page hentry entry">';
	echo '<h1 class="entry-title">'. get_the_title() .'</h1>';
	echo '<div class="entry-content">' . get_the_content() ;
     
     
	$args = array(
		'post_type' => 'topic', // enter your custom post type
		'orderby' => 'date',
		'order' => 'DESC',
		
	);
	$loop = new WP_Query( $args );
	
	if( $loop->have_posts() ):
				
		while( $loop->have_posts() ): $loop->the_post(); global $post;
			$parentID = get_the_ID();
			$topicLink = get_page_link($id, $leavename, $sample);
			$parent = get_post($post0>post_parent);
			$parent_title = get_the_title($parent);
			$grandparent = $parent->post_parent;
			$grandparent_title = get_the_title($grandparent);
			$author = get_the_author_meta ();
			$postLink = get_permalink();
			$categoryLink = get_permalink($parentID);
			//echo 'author id is ' . $author;
			$postID = get_the_ID();
			
			echo '<div class="well well-sm threadWell">';
			echo '<div class="topicContainer">';
			echo '<div class="threadAvatar">' . get_avatar( get_the_author_meta( 'ID' ), 16 ) . '</div>';
			echo	'<div class="threadAuthor">' . '<a href="' . bp_core_get_user_domain($author) . '">' . get_the_author() . '</a></div>';
			echo	'<div class="threadTopic">' . get_the_title() . '</div>';
			echo 	'<div class="threadContent">' . get_the_content() . '</div>';				
			?>
               <div class="threadFooter">
                   <div class="btn-group btn-group-xs threadButtonGroup" role="group" aria-label="...">
                      <button onclick="window.location='<?php echo $postLink; ?>'" type="button" title="Go to Topic" class="btn btn-default">Open</button>
                      <button onclick="myFunction()" type="button" title="Feature not implemented yet! GO Utes!" class="btn btn-default">Reply</button>
                      <button type="button" class="btn btn-default">
                         <!-- LikeBtn.com BEGIN -->
                         <span data-site_id="5609af653866e16219456fa6" data-popup_disabled="true" class="likebtn-wrapper" data-theme="transparent" data-white_label="true" data-identifier="bbp_post_<?php echo $postID; ?>" data-show_dislike_label="true"></span>
                         <script>(function(d,e,s){if(d.getElementById("likebtn_wjs_<?php echo $postID; ?>"))return;a=d.createElement(e);m=d.getElementsByTagName(e)[0];a.async=1;a.id="likebtn_wjs_<?php echo $postID; ?>";a.src=s;m.parentNode.insertBefore(a, m)})(document,"script","//w.likebtn.com/js/w/widget.js");</script>
                         <!-- LikeBtn.com END -->
                      </button>
                      <button onclick="myFunction()" type="button" title="Feature not implemented yet! GO Utes!" class="btn btn-default">Spam</button>
                      <button onclick="myFunction()" type="button" title="Feature not implemented yet! GO Utes!" class="btn btn-default">Tweet</button>
                      <button onclick="myFunction()" type="button" title="Feature not implemented yet! GO Utes!" class="btn btn-default">Facebook</button>
                    </div>
                   <?php
			     echo '<div class="threadDate">'. get_the_date() . ' ' . get_the_time() . ' In: '. $grandparent_title . '</div>';
			    ?>
               </div>
               
               <?php
			
			
			echo '</div>';
			//echo ' &nbsp;&nbsp;[reply][share][email]</div>';
			
			$args = array(
				'post_type' => 'reply', // enter your custom post type
				'posts_per_page'         => '20',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'post_parent' => $parentID,
				
				
			);
			$loopReply = new WP_Query( $args );
			
			while( $loopReply->have_posts() ): $loopReply->the_post(); global $post;
				$reply = get_the_content(); 
				$author = get_the_author_meta ();
				$replyLink = get_permalink();
				$replyID = get_the_ID();

				echo '<div class="replyContainer">';
				echo '<div class="threadAvatar">' . get_avatar( get_the_author_meta( 'ID' ), 16 ) . '</div>';
				echo	'<div class="threadAuthor">' . '<a href="' . bp_core_get_user_domain($author) . '">' . get_the_author() . '</a></div>';
				 	//'<div class="threadTopic">' . get_the_title() . '</div>';
				echo 	'<div class="replyContent">' . get_the_content() . '</div>';
			?>
               <div class="threadFooter">
                   <div class="btn-group btn-group-xs threadButtonGroup" role="group" aria-label="...">
                      <button onclick="window.location='<?php echo $postLink . '/#post-' . $replyID; ?>'" type="button" title="Go to Reply" class="btn btn-default">Open</button>
                      <button onclick="myFunction()" type="button" title="Feature not implemented yet! GO Utes!" class="btn btn-default">Reply</button>
                      <button type="button" class="btn btn-default">
                         <!-- LikeBtn.com BEGIN -->
                         <span data-site_id="5609af653866e16219456fa6" data-popup_disabled="true" class="likebtn-wrapper" data-theme="transparent" data-white_label="true" data-identifier="bbp_post_<?php echo $replyID; ?>" data-show_dislike_label="true"></span>
                         <script>(function(d,e,s){if(d.getElementById("likebtn_wjs_<?php echo $replyID; ?>"))return;a=d.createElement(e);m=d.getElementsByTagName(e)[0];a.async=1;a.id="likebtn_wjs_<?php echo $replyID; ?>";a.src=s;m.parentNode.insertBefore(a, m)})(document,"script","//w.likebtn.com/js/w/widget.js");</script>
                         <!-- LikeBtn.com END -->
                      </button>
                      <button onclick="myFunction()" type="button" title="Feature not implemented yet! GO Utes!" class="btn btn-default">Spam</button>
                      <button onclick="myFunction()" type="button" title="Feature not implemented yet! GO Utes!" class="btn btn-default">Tweet</button>
                      <button onclick="myFunction()" type="button" title="Feature not implemented yet! GO Utes!" class="btn btn-default">Facebook</button>
                    </div>
                   <?php
			     echo '<div class="threadDate">'. get_the_date() . ' ' . get_the_time() . ' In: '. $grandparent_title. '</div>';
			    ?>
               </div>
               
               <?php				echo '</div>';
				
			
				
				
		
			
			//echo '<blockquote><p>' . get_the_content() . '</p></blockquote>';
	
		
		endwhile;
		echo '</div>';
		endwhile;
		
	endif;
	
	
	?>
   <div class="navigation well col-sm-12" align="center">
   <!-- ADD Custom Numbered Pagination code. -->
   <?php if(function_exists('pagenavi')) { pagenavi(); } ?>
   </div> 
   <?php
   
	// Outro Text (hard coded)
	echo '</div><!-- end .entry-content -->';
	echo '</div><!-- end .page .hentry .entry -->';

?>


</div>

      <div class="col-md-3 col-lg-3">
        <?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
        <div id="secondary" class="sidebar-container" role="complementary">
          <div class="widget-area">
            <?php dynamic_sidebar( 'sidebar-6' ); ?>
          </div>
          <!-- .widget-area --> 
        </div>
        <!-- #secondary -->
        <?php endif; ?>
      </div>
      
      
  </div>
</div>
<?php

	// Gets footer.php
	get_footer(); 
?>
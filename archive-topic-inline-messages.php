<?php
/**
 * Template Name: Threaded-View-Inline-Messages
 * Description: Used as a page template to show page contents, followed by a loop through a topics archive
 */
 // Gets header.php
	get_header();

//---------------   enable plugins, specifically bbpress		 ---------------//
//var_dump($_POST);

include_once(ABSPATH.'wp-admin/includes/plugin.php');

// Full path to WordPress from the root
$wordpress_path = '/full/path/to/wordpress/';
// Absolute path to plugins dir
$plugin_path = $wordpress_path.'wp-content/plugins/';
// Absolute path to your specific plugin
$my_plugin = $plugin_path.'/bbpress/bbpress.php';
// Check to see if plugin is already active

$nonce = wp_create_nonce( 'tk_forum_message' );
//echo $nonce;

$author_id = get_current_user_id();

//I wonder what this is?
if(is_plugin_active($my_plugin)) {
	deactivate_plugins($my_plugin);
}
else {
	// Activate plugin
	activate_plugin($my_plugin);
}

if(isset($_GET['th'])){
		$th = $_GET['th'];
	} else {
    $th = 0;
  }

if(isset($_POST) && array_key_exists('task',$_POST)){

	$task = $_POST['task'];

$retrieved_nonce = $_REQUEST['_wpnonce'];
		if (!wp_verify_nonce($retrieved_nonce, 'tk_forum_message' ) ) die( 'Failed security check' );

	if(isset($_POST) && array_key_exists('post_title',$_POST)){
		$post_title = $_POST['post_title'];
		//echo 'post_title is ' . $post_title . '<br />';
	}
	if(isset($_POST) && array_key_exists('forum_id',$_POST)){
		$forum_id = $_POST['forum_id'];
		//echo 'forum_id is ' . $forum_id . '<br />';
	}
	if(isset($_POST) && array_key_exists('bbp_forum_id',$_POST)){
		$bbp_forum_id = $_POST['bbp_forum_id'];
		//echo 'bbp_forum_id is ' . $bbp_forum_id . '<br />';
	}
	// Here we need to see if bbp_forum_id has posted. If so that means something was selected in the forum dropdown. We will replace the hidden forum_id with this //
	if($bbp_forum_id != NULL){
		$forum_id = $bbp_forum_id;
	}

	if($task == "replyPost"){
		$post_content = array_shift($_POST);
	}
	if(isset($_POST) && array_key_exists('post_content',$_POST)){
		$post_content = $_POST['post_content'];
	}

	if(isset($_POST) && array_key_exists('post_parent',$_POST)){
		$post_parent = $_POST['post_parent'];
	}
	if(isset($_POST) && array_key_exists('topic_id',$_POST)){
		$topic_id = $_POST['topic_id'];
	}
	if(isset($_POST) && array_key_exists('post_author',$_POST)){
		$post_author = $_POST['post_author'];
	}
	if ( isset( $_REQUEST['bbp_reply_to'] ) ) {
		$reply_to = bbp_validate_reply_to( $_REQUEST['bbp_reply_to'] );
		$reply_id = bbp_validate_reply_to( $_REQUEST['bbp_reply_to'] );

	}
	$post_date = current_time( 'mysql' );
	$replyUserIP = $_SERVER['REMOTE_ADDR'];

	//bbp_get_reply_position_raw( $reply_id = 0, $topic_id = 0 );

	// If no position was passed, get it from the db and update the menu_order
		if ( empty( $reply_position ) ) {
			$reply_position = bbp_get_reply_position_raw( $reply_id, bbp_get_reply_topic_id( $reply_id ) );


		}

	}

if(isset($_POST) && array_key_exists('task',$_POST)){

	if ($task == 'newPost') {
			$task = "";
			/** Topic Flooding ********************************************************/


	/** Insert ********************************************************************/
	global $wp_query, $wpdb;
	$curauth = $wp_query->get_queried_object();
	$post_count = $wpdb->get_var("SELECT COUNT(ID) FROM ".$wpdb->prefix."posts WHERE post_author = '" . $post_author . "' AND post_type = 'topic' AND post_content = '$post_content'");


	if($post_count > 0){echo '<script> alert("Repost Error! Please do not hit the back button or refresh your browser after posting!")</script>';}
	if($post_count < 1){

	$topic_data = array();

	// Parse arguments against default values
	$topic_data = array (
		'post_parent'    => $forum_id, // forum ID
		'post_status'    => 'publish',
		'post_type'      => 'topic',
		'post_author'    => $post_author,
		'post_content'   => $post_content,
		'post_title'     => $post_title,
		'comment_status' => 'closed',
		'menu_order'     => 0
		 );
		 //error_log($post_content);
	// Insert topic
	$topic_id   = wp_insert_post( $topic_data );

// 	$prefix = $wpdb->prefix;
// 	$wpdb->insert(
// 	$prefix. 'posts',
// 	$topic_data,
// 	array(
// 		'%d',
// 		'%s',
// 		'%s',
// 		'%d',
// 		'%s',
// 		'%s',
// 		'%s',
// 		'%d'
// 	)
// );

	// Bail if no topic was added
	if ( empty( $topic_id ) )
		return false;

	// Parse arguments against default values
	$topic_meta = array(
		'author_ip'          => $replyUserIP,
		'forum_id'           => $forum_id,
		'topic_id'           => $topic_id,
		'voice_count'        => 1,
		'reply_count'        => 0,
		'reply_count_hidden' => 0,
		'last_reply_id'      => 0,
		'last_active_id'     => $topic_id,
		'last_active_time'   => get_post_field( 'post_date', $topic_id, 'db' )
		);

	// Insert topic meta
	foreach ( $topic_meta as $meta_key => $meta_value ) {
		update_post_meta( $topic_id, '_bbp_' . $meta_key, $meta_value );
	}

	// Update the forum
	$forum_id = bbp_get_topic_forum_id( $topic_id );
	if ( !empty( $forum_id ) ) {
		bbp_update_forum( array( 'forum_id' => $forum_id ) );
	}

	$user_info = get_userdata($post_author);
	$user_nice_name = $user_info->user_nicename;
  	$author_url = bp_core_get_user_domain( $post_author );
  	$bp_bbp_permalink = esc_url(get_permalink($topic_id));
  	$forum_url = get_permalink($forum_id);
	$bp_bbp_action = '<a href="' . $author_url. '">' . $user_nice_name . '</a> started the topic <a href="' . $bp_bbp_permalink . '">' . $post_title . '</a> in the <a href="'. $forum_url . '">' . get_the_title($forum_id) . '</a> forum.';;


	// Post to buddyPress activity stream
	global $wpdb;
	$table_name = $wpdb->prefix . "bp_activity";
	$wpdb->insert(
		$table_name,
			array(
				'user_id' 			  => $post_author,
				'type' 			      => 'bbp_topic_create',
				'action'              => $bp_bbp_action,
				'item_id'             => $topic_id,
				'secondary_item_id'   => $forum_id,
				'content'             => $post_content,
				'primary_link'        => $bp_bbp_permalink,
				'component'           => 'bbpress',
				'date_recorded'       => bp_core_current_time()
			),
			array(
				'%d',
				'%s',
				'%s',
				'%d',
				'%d',
				'%s',
				'%s',
				'%s',
				'%s'
			)
		);

	// Return new topic ID
	//return $topic_id;
	unset($_POST);

}
	}
	//--------------------- END OF INSERT NEW POST - task newPost ------------------------  //


	//--------------------- postReply  ------------------------  //

	if ($task == 'replyPost') {

	global $wp_query, $wpdb;
	$curauth = $wp_query->get_queried_object();
	$post_count = $wpdb->get_var("SELECT COUNT(ID) FROM ".$wpdb->prefix."posts WHERE post_author = '" . $post_author . "' AND post_type = 'reply' AND post_content = '$post_content'");


	if($post_count > 0){echo '<script> alert("Repost Error! Please do not hit the back button or refresh your browser after posting!")</script>';}
	if($post_count < 1){
			// Forum

		$reply_data = array();
		$reply_meta = array();

		// Forum
		$reply_data = bbp_parse_args( $reply_data, array(
			'post_parent'    => $topic_id, // topic ID
			'post_status'    => 'publish',
			'post_type'      => 'reply',
			'post_author'    => bbp_get_current_user_id(),
			'post_password'  => '',
			'post_content'   => $post_content,
			'post_title'     => '',
			'menu_order'     => bbp_get_topic_reply_count( $topic_id, false ) + 1,
			'comment_status' => 'closed'
		), 'insert_reply' );


		// Insert reply
		$reply_id   = wp_insert_post( $reply_data );

		// Bail if no reply was added
		if ( empty( $reply_id ) ) {
			return false;
		}

		if($reply_to > 0){
			// Forum meta
			$reply_meta = bbp_parse_args( $reply_meta, array(
				'author_ip' => bbp_current_author_ip(),
				'forum_id'  => $forum_id,
				'topic_id'  => $topic_id,
				'reply_to'  => $reply_to,
			), 'insert_reply_meta' );
		}
		if($reply_to == 0){
			// Forum meta
			$reply_meta = bbp_parse_args( $reply_meta, array(
				'author_ip' => bbp_current_author_ip(),
				'forum_id'  => $forum_id,
				'topic_id'  => $topic_id,
			), 'insert_reply_meta' );
		}

		// Insert reply meta
		foreach ( $reply_meta as $meta_key => $meta_value ) {
			update_post_meta( $reply_id, '_bbp_' . $meta_key, $meta_value );
		}

		// Update the topic
		$topic_id = bbp_get_reply_topic_id( $reply_id );
		if ( !empty( $topic_id ) ) {
			bbp_update_topic( $topic_id );
		}

		unset($_POST);

	}
}

//--------------------- END OF postReply ------------------------  //

	if ($task == 'replyReply') {

		// Create post object
		$post_id = wp_insert_post(array (
		  'post_title'    	=> '',
		  'post_content'  	=> $post_content,
		  'post_status'   	=> 'publish',
		  'post_author'   	=> $post_author,
		  'post_type' 	   	=> 'reply',
		  'post_parent' 	=> $post_parent
		));

		if ($post_id) {
		// insert post meta
		add_post_meta($post_id, '_bbp_forum_id', $forum_id, false);
		add_post_meta($post_id, '_bbp_topic_id', $topic_id, false);
		add_post_meta($post_id, '_bbp_reply_to', $reply_to, false);
		add_post_meta($post_id, '_bbp_author_ip', $replyUserIP, false);
		$task = "";
		unset($_POST);
		}
	}

}
	?>
<div class="container">

  <div class="row mobileContent browserContent">
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 well well-sm" id="registerContent">
      	<?php if ( is_active_sidebar( 'sidebar-8' ) ) : ?>
      		<?php dynamic_sidebar( 'sidebar-8' ); ?>
      	<?php endif; ?>
      	<div class="col-xs-12 clearfix fahk no-pad">
        <div class="col-xs-12 col-md-6 text-left no-pad"> <?php echo '<h1 class="threaded-title">'. get_the_title() .'</h1>'; ?> </div>
        <div class="col-xs-12 col-md-6 text-right no-pad">
			<button title="Expand or shrink all board replies on this page! Individual topics can be overridden." id="expand-replies" class="expand-replies-hide btn btn-sm btn-default">Hide All Replies</button>
			<button title="Expand or shrink all board messages on this page! It is like clicking the more button a billeon times!" class="btn btn-sm btn-default expand-all">Expand All</button>
          <?php if ( is_user_logged_in()) { ?>
          	<button id="threaded-new-message" type="button" title="Post a New Message" class="newMessage btn btn-success btn-sm">New Message</button>
          <?php } else { ?>
          	<button id="threaded-new-message-disabled" onclick="lognToReply()" type="button" title="Login to post a message..." class="newMessage-disabled btn-sm btn btn-success">New Message</button>
          <?php	 } ?>
        </div>
      </div>

	<div class="page hentry entry">

	<?php get_the_content(); ?>

	<?php  if (is_user_logged_in() > 0) { ?>

		<div id="dialog" title="New Message">
		    <form id="reply-post" name="new-post" method="post" action="<?php echo $_SERVER["REQUEST_URI"] ?>">
				<div class="submit-header col-xs-12 no-pad">
					<div class="col-xs-6 no-pad">
						<h1 id="h1_new_message" class="pull-left">Post New Message</h1>
					</div>
					<div class="col-xs-6 no-pad">
						<button type="submit" id="newPost_submit" name="bbp_reply_submit" class="btn btn-sm btn-default btn-success pull-right" disabled="disabled">Submit</button>
						<button type="button" class="btn btn-default btn-warning btn-sm pull-right" onclick="cancelNewPost()">Cancel</button>
					</div>
				</div>
		          <label class="hide_on_reply" for="bbp_topic_title"><?php printf( __( 'Topic Title (Maximum Length: %d):', 'bbpress' ), bbp_get_title_max_length() ); ?></label>
		          <br />
		          <input class="form-control" type="text" id="bbp_topic_title" value="<?php bbp_form_topic_title(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="50" name="post_title" maxlength="<?php bbp_title_max_length(); ?>" />
		          <p class="hide_on_reply">
		        	<label class="hide_on_reply" for="bbp_forum_id">
		            	<?php _e( 'Forum:', 'bbpress' ); ?>
		            </label>
		            <br />
		            <?php
		            	bbp_dropdown( array(
			                	'show_none' => __( '(No Forum)', 'bbpress' ),
			                   	'selected'  => bbp_get_form_topic_forum()
		                	)
						);
		        	?>
		          </p>
		        <!-- forum select list) -->
				<textarea id="post_content" name="post_content"></textarea>

		        <input type="hidden" name="topic_id" id="topic_id" value="<?php if(isset($topic_id)){echo $topic_id;} ?>">
		        <input type="hidden" name="post_parent" id="post_parent" value="<?php if(isset($parentID)){echo $parentID;} ?>">
		        <input type="hidden" name="bbp_reply_to" id="bbp_reply_to" value="">
		        <input type="hidden" name="post_author" id="post_author" value="<?php $post_author = get_current_user_id(); echo $post_author; ?>">
		        <input type="hidden" name="task" id="postTask" value="newPost">
		        <?php wp_nonce_field('tk_forum_message'); ?>
		      </form>
		</div>
	<?php
	} // end if user is logged in
	//Protect against arbitrary paged values
	$paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;

  if ($th > 0){
    $args = array(
	    'p' => $th,
	    'post_type' => 'topic'
    );
  } else {
		$args = array(
		'post_type' => 'topic', // enter your custom post type
		'orderby' => 'date',
		'order' => 'DESC',
		'posts_per_page' => 10,
		'paged' => $paged
	);
  }
	$loop = new WP_Query( $args );

	if( $loop->have_posts() ):

		while( $loop->have_posts() ): $loop->the_post(); global $post;

			$the_content = apply_filters('the_content', get_the_content());
			$parentID = get_the_ID();
			$topicLink = get_page_link();
			$parent = get_the_ID();
			$parent_title = get_the_title($parent);
			$grandparent_title = get_the_title();
			$author = get_the_author_meta( 'ID' );
			$postLink = get_permalink();
			$categoryLink = get_permalink($parentID);
			$postID = get_the_ID();
			$menu_order = $post->menu_order;
			$forum_id = get_post_meta( get_the_ID(), '_bbp_forum_id', true);
			$topic_id = get_post_meta( get_the_ID(), '_bbp_topic_id', true);
	          $thread_url =  get_site_url() . '?th='.$parentID;
			$forum_title = get_the_title($forum_id);
			$forum_link = get_permalink($forum_id);
			$post_status = get_post_status();

			$avatar = get_avatar( get_the_author_meta( 'ID' ), 40 );

			$timestamp = get_the_time('U');
			$time = calc_time_diff($timestamp, NULL, TRUE);
			// if (strpos($avatar, 'gravatar') !== false) {
			//     $avatar = '<img src="' . get_site_url() . '/wp-content/uploads/2016/08/UTAH.png" width="16" height="16">';
			// }

			$reply_count = $wpdb->get_var("SELECT COUNT(ID) FROM ".$wpdb->prefix."posts WHERE post_type = 'reply' AND post_parent = '$topic_id' AND post_status = 'publish'");
			//echo 'reply count ' . $reply_count;
			?>
			<div class="well well-sm threadWell">
				<div class="topicContainer">
						<!-- <div class="threadContainer"> -->
							<div class="threadHeader">
								<div class="threadAvatar"><?php echo $avatar; ?></div>

								<div class="threadAuthor"><a href="<?php echo bp_core_get_user_domain($author); ?>"><?php echo get_the_author(); ?></a>
									<span class="postInfo"><a href="<?php echo $forum_link; ?>"><?php echo $forum_title; ?></a>
									 &nbsp;&nbsp;<?php echo $time ?></span>
								</div>

								<div class="pull-right"><?php echo tk_like_buttons(); ?> </div>
							</div>
							<div class="threadTopic"><?php echo get_the_title(); ?>


							</div>
							<div class="threadContent contentLess" id="threadContent_' . $postID . '"><?php echo $the_content; ?></div>
							<button type="button" title="Click to see more/less content" class="more_button footer_button" id="expandContent_<?php echo $postID; ?>">More</button>
								<?php if($reply_count > 0) { ?>
									<button type="button" title="Click to show/hide replies for this topic" alt="This topic is closed to replies" class="hide-replies-button footer_button">Hide Replies</button>
								<?php } ?>
								<button onclick="window.location='<?php echo $postLink; ?>'" type="button" title="Go to Topic in Forum Area" class="footer_button">Open</button>

								<?php if ($post_status == 'closed'){ ?>
										<button type="button" class="footer_button disabled" title="Topic Closed">Topic Closed</button>
									<?php } else {
										if ( is_user_logged_in()) { ?>
											<button type="button" id="replyPost_<?php echo $parentID; ?>"
												data-nonce="<?php echo $nonce; ?>"
												data-task="replyPost"
												data-reply-id="<?php echo $parentID; ?>"
												data-user-id="<?php echo $author_id; ?>"
												onclick="replyPost_id = <?php echo $parentID; ?>;
												topic_id = <?php echo $parentID; ?>;
												forum_id = <?php echo $forum_id; ?>;
												" class="comment footer_button">Reply
											</button>
									<?php } else { ?>
										<button onclick="lognToReply()" type="button" title="" class="footer_button">Reply</button>
									<?php }
								} ?>

								<button type="button" title="Share this topic on Twitter or Facebook" class="footer_button">
								  <a href="http://twitter.com/share?text=<?php echo get_the_title(); ?>&via=Ute_Hub&hashtags=GoUtes&url=<?php echo $thread_url; ?>" target="_blank"><i class="twitter"></i></a> </button>

								 <button type="button" title="Share this topic on Twitter or Facebook" class="footer_button"> <a href="https://facebook.com/sharer.php?u=<?php echo $thread_url; ?>" target="_blank"><i class="facebook"></i></a></button>
								<!-- </div>
								</div> -->

						<!-- </div> -->


				</div> <!-- topic container -->
				<div class="editor"></div>

<?php
			$args = array(
				'post_type' 		=> 'reply', // enter your custom post type
				'posts_per_page'    => '50',
				'orderby' 		=> 'menu_order',
				'order' 			=> 'ASC',
				'post_parent' 		=> $topic_id,
			);
			$loopReply = new WP_Query( $args );

////////  REPLY LOOP /////////////////////////////////////////////////////////


			echo '<div class="replies show_reply">';

				while( $loopReply->have_posts() ): $loopReply->the_post(); global $post;
					$reply = apply_filters('the_content', get_the_content());
					$author = get_the_author_meta( 'ID' );
					$replyLink = get_permalink();
					$replyID = get_the_ID();
					$post_parent = get_the_ID();
					$forum_id = get_post_meta( get_the_ID($replyID), '_bbp_forum_id', true);
					$topic_id = get_post_meta( get_the_ID($replyID), '_bbp_topic_id', true);
					$menu_order = $post->menu_order;
					$avatar = get_avatar( get_the_author_meta( 'ID' ), 40 );
					$timestamp = get_the_time('U');
					$time = calc_time_diff($timestamp, NULL, TRUE);

					?>

					<div class="replyContainer show_reply">
						<div class="threadHeader">
							<div class="replyAvatar"><?php echo $avatar; ?></div>
							<div class="pull-right reply_like_buttons"><?php echo tk_like_buttons(); ?> </div>
							<div class="replyAuthor"><a href="<?php echo bp_core_get_user_domain($author); ?>"><?php echo get_the_author(); ?></a>
								<span class="postInfo"><?php echo $time ?></span>
							</div>

						</div>

					<div class="replyContent contentLess" id="threadContent_<?php echo $replyID; ?>"><?php echo $reply; ?></div>
							<button type="button" title="Click to see more/less content" alt="This topic is closed to replies" class="more_button footer_button reply_more_button" id="expandContent_<?php echo $postID; ?>">More</button>
							<button onclick="window.location='<?php echo $postLink . '/#post-' . $replyID; ?>'" type="button" title="Go to Reply in Forum Area - Videos, Twitter, various media may work better in the main forum" class="footer_button">Open</button>

							<?php if ($post_status == 'closed'){ ?>
									<button type="button" class="footer_button disabled" title="Topic Closed">Topic Closed</button>
								<?php } else {
									if ( is_user_logged_in()) { ?>
										<button type="button" id="replyPost_<?php echo $parentID; ?>"
											data-nonce="<?php echo $nonce; ?>"
											data-task="replyPost"
											data-reply-id="<?php echo $replyID; ?>"
											data-user-id="<?php echo $author_id; ?>"
											onclick="replyPost_id = <?php echo $parentID; ?>;
											topic_id = <?php echo $parentID; ?>;
											forum_id = <?php echo $forum_id; ?>;
											" class="comment footer_button">Reply
										</button>
									<?php } else { ?>
										<button onclick="lognToReply()" type="button" title="" class="footer_button">Reply</button>
									<?php }
							} ?>
		 			</div>
					<div class="editor"></div>

				<?php endwhile; ?>
		  		</div>
				</div>
		<?php endwhile; ?>

	<?php endif; ?>

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
        		</div> <!-- .widget-area -->
      		</div> <!-- #secondary -->
      	<?php endif; ?>
    </div>

</div> <!-- row mobileContent browserContent -->
</div> <!-- containersecondary -->

<?php get_footer(); ?>

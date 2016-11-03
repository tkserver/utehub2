<?php
/**
 * Template Name: Threaded-View-Like-Clean-Hide-Replies-Editor-jquery-modal
 * Description: Used as a page template to show page contents, followed by a loop through a topics archive
 */
 // Gets header.php
	get_header();

//---------------   enable plugins, specifically bbpress		 ---------------//



// include_once(ABSPATH.'wp-includes/js/tinymce/tinymce.min.js');

include_once(ABSPATH.'wp-admin/includes/plugin.php');


	// Full path to WordPress from the root
	$wordpress_path = '/full/path/to/wordpress/';

	// Absolute path to plugins dir
	$plugin_path = $wordpress_path.'wp-content/plugins/';

	// Absolute path to your specific plugin
	$my_plugin = $plugin_path.'/bbpress/bbpress.php';

	// Check to see if plugin is already active
	if(is_plugin_active($my_plugin)) {

		deactivate_plugins($my_plugin);
	}
	else {
		// Activate plugin
		activate_plugin($my_plugin);
	}

	?>

<script>

jQuery(document).ready(function(){
	template_dir = "<?php echo get_template_directory_uri(); ?>"
    jQuery('#ajax-new-message').click(function(){
        //jQuery('#new-message').load(template_dir + '/new-post-wysihtml5.php',
		jQuery('#new-message').load(template_dir + '/new-post.php',
			{
				name: "fred"
			})
    });
})


	task = "";

	function myFunction() {
    	alert("Feature not implemented yet! GO UTES!");
	}
    function lognToReply() {
    	alert("Please login (or register) to post a message. GO UTES!");
	}

	function cancelPost(){
		jQuery("#dialog").animate({height:0},500);
		curHeight = undefined;
		autoHeight = undefined;
		el = undefined;
		jQuery('#post_content, #bbp_topic_title, #bbp_forum_id').val("");
		jQuery(".cancelPost").text('Reply').removeClass("cancelPost btn-warning").addClass("replyPost");
	}

	jQuery(document).on('click', '.cancelPost', function() {
			cancelPost();
	});

	jQuery(document).on('click', '#threaded-new-message-cancel', function() {
		cancelPost();
		jQuery(this).attr("id","threaded-new-message").text('New Message').addClass("btn-success newMessage");
	});


	jQuery(document).on('click', '#threaded-new-message', function() {
		jQuery("#dialog").width("100%");
		//cool way to animate auto height!
		var el = jQuery('#dialog'),
	    curHeight = el.height(),
	    autoHeight = el.css('height', 'auto').height();
		el.height(curHeight).animate({height: autoHeight}, 1000);
		jQuery("#dialog").show().insertAfter(jQuery(this).parent());
		jQuery("#dialog").insertAfter(jQuery(".entry-content"));
		jQuery("#h1_new_message").text("Post New Topic");
		jQuery("#postTask").val("newPost");
		jQuery("#bbp_topic_title").removeClass('hidden');
		jQuery("#bbp_forum_id").removeClass('hidden');
		jQuery(".hide_on_reply").removeClass('hidden');
		jQuery('.cancelPost').addClass('replyPost').removeClass('cancelPost btn-warning').text('Reply');
		jQuery('#threaded-new-message').addClass('btn-warning').removeClass('btn-success').text('Cancel');
		jQuery(this).attr("id","threaded-new-message-cancel");
		jQuery
		task = undefined;
	});

jQuery(document).ready(function() {
	jQuery(document).on('click', '.replyPost', function(){
		// editor_id = Math.random();
		// alert(editor_id);
		// jQuery("#post_content").attr("id", editor_id);

		jQuery(this).text('Cancel').addClass("btn-warning cancelPost").removeClass("replyPost");
		//cool way to animate auto height!
		var el = jQuery('#dialog'),
		curHeight = el.height(),
		autoHeight = el.css('height', 'auto').height();
		el.height(curHeight).animate({height: autoHeight}, 1000);
		jQuery("#dialog").show().insertAfter(jQuery(replyPost_id).parent());
		jQuery("#postTask").val("replyPost");
		jQuery("#topic_id").val(topic_id);
		jQuery("#forum_id").val(forum_id);

		jQuery("#bbp_topic_title").addClass('hidden');
		jQuery("#bbp_forum_id").addClass('hidden');
		jQuery(".hide_on_reply").addClass('hidden');
		jQuery("#h1_new_message").text("Post Reply");
		jQuery('.cancelPost').not(this).addClass('replyPost').removeClass('cancelPost btn-warning').text('Reply');
		task = undefined;
	})

});


	function replyReply(topic_id, forum_id, reply_to) {
		//cool way to animate auto height!
		var el = jQuery('#dialog'),
		curHeight = el.height(),
		autoHeight = el.css('height', 'auto').height();
		el.height(curHeight).animate({height: autoHeight}, 1000);
		jQuery("#postTask").val("replyPost");
		jQuery("#topic_id").val(topic_id);
		jQuery("#forum_id").val(forum_id);
		jQuery("#bbp_topic_title").hide();
		jQuery("#bbp_forum_id").hide();
		jQuery(".hide_on_reply").hide();
		jQuery("#h1_new_message").text("Post Reply");
		jQuery("#bbp_reply_to").val(reply_to);
		task = undefined;
	}

//this makes sure the user has filled in the title, category, and some text into the new topic fields
	// jQuery(document).ready(function (){
	//     validate();
	//     jQuery('#bbp_topic_title, #bbp_forum_id').change(validate);
	// });
	//
	// function validate(){
	//     if (jQuery('#bbp_topic_title').val().length   >   0   &&
	//         jQuery('#bbp_forum_id').val().length  >   0) {
			//tinyMCE.get('tinyeditor').getContent().length > 0) {
	        //jQuery('#post_content').val().length    >   0) {
	//         jQuery("#bbp_reply_submit").prop("disabled", false);
	//     }
	//     else {
	//         jQuery("#bbp_reply_submit").prop("disabled", true);
	//     }
	// }



	jQuery.fn.extend({
			toggleText:function(a,b){
				if(this.html()==a){this.html(b)}
				else{this.html(a)}
		}
	});

	jQuery(document).ready(function() {
		jQuery('.more_button').click(function(){
			if(jQuery(this).prevAll(".threadContent, .replyContent").hasClass("contentLess")) {
				jQuery(this).prevAll(".threadContent, .replyContent").removeClass("contentLess");
				jQuery(this).prevAll(".threadContent, .replyContent").addClass("contentMore");
				jQuery(this).addClass("active");
				jQuery(this).text("Less");
			} else {
				jQuery(this).prevAll(".threadContent, .replyContent").removeClass("contentMore");
				jQuery(this).prevAll(".threadContent, .replyContent").addClass("contentLess");
				jQuery(this).removeClass("active");
				jQuery(this).text("More");
			}
			return false;
		});

		jQuery('.expand-all').click(function(){
			if(jQuery(".threadContent, .replyContent").hasClass("contentLess")) {
				jQuery(".threadContent, .replyContent").removeClass("contentLess");
				jQuery(".threadContent, .replyContent").addClass("contentMore");
				jQuery(".more_button").addClass("active");
				jQuery(".more_button").text("Less");
				jQuery(this).addClass("active");
				jQuery(this).text("Shrink All");
			} else {
				jQuery(".threadContent, .replyContent").removeClass("contentMore");
				jQuery(".threadContent, .replyContent").addClass("contentLess");
				jQuery(".more_button").removeClass("active");
				jQuery(".more_button").text("More");
				jQuery(this).removeClass("active");
				jQuery(this).text("Expand All");
			}
			return false;
		});

		jQuery('#expand-replies').click(function(){
			if(jQuery(".replies").hasClass("show_reply")) {
					jQuery(".replies").removeClass("show_reply");
					jQuery(".replies").addClass("hide_reply");
					jQuery(".show-replies-button").text("Show Replies");
					jQuery(this).text("Show Replies");
			} else {
					jQuery(".replies").removeClass("hide_reply");
					jQuery(".replies").addClass("show_reply");
					jQuery(".show-replies-button").text("Hide Replies");
					jQuery(this).text("Hide Replies");
			}
			return false;
		});

		jQuery('.show-replies-button').click(function(){
			if(jQuery(this).parent().next(".replies").hasClass("show_reply")) {
					jQuery(this).parent().next(".replies").removeClass("show_reply");
					jQuery(this).parent().next(".replies").addClass("hide_reply");
					jQuery(this).text("Show Replies");
			} else {
					jQuery(this).parent().next(".replies").removeClass("hide_reply");
					jQuery(this).parent().next(".replies").addClass("show_reply");
					jQuery(this).text("Hide Replies");
			}
			return false;
		});
	});

</script>

<script>
	function openThread () {
		window.open("postlink","_self")
	}
</script>
<?php

if(isset($_GET['th'])){
		$th = $_GET['th'];
	} else {
    $th = 0;
  }

if(isset($_POST) && array_key_exists('task',$_POST)){

	$task = $_POST['task'];

	echo "task: " . $task;

// $retrieved_nonce = $_REQUEST['_wpnonce'];
// 		if (!wp_verify_nonce($retrieved_nonce, 'tk_forum_message' ) ) die( 'Failed security check' );

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
	$post_content = $_POST['post_content'];

	if(isset($_POST) && array_key_exists('post_parent',$_POST)){
		$post_parent = $_POST['post_parent'];
		//echo 'post_parent is ' . $post_parent . '<br />';
	}
	if(isset($_POST) && array_key_exists('topic_id',$_POST)){
		$topic_id = $_POST['topic_id'];
		//echo 'topic_id is ' . $topic_id . '<br />';
	}
	if(isset($_POST) && array_key_exists('post_author',$_POST)){
		$post_author = $_POST['post_author'];
		//echo 'post_author is ' . $post_author . '<br />';
	}
	if ( isset( $_REQUEST['bbp_reply_to'] ) ) {
		$reply_to = bbp_validate_reply_to( $_REQUEST['bbp_reply_to'] );
		$reply_id = bbp_validate_reply_to( $_REQUEST['bbp_reply_to'] );
		//echo 'reply_to is ' . $reply_to . '<br />';

	}
	$post_date = current_time( 'mysql' );
	$replyUserIP = $_SERVER['REMOTE_ADDR'];

	//bbp_get_reply_position_raw( $reply_id = 0, $topic_id = 0 );

	// If no position was passed, get it from the db and update the menu_order
	if ( empty( $reply_position ) ) {
		$reply_position = bbp_get_reply_position_raw( $reply_id, bbp_get_reply_topic_id( $reply_id ) );


	}
	//echo 'reply_position is ' . $reply_position;



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

	// Insert topic
	$topic_id   = wp_insert_post( $topic_data );

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
		  'post_title'    => '',
		  'post_content'  => $post_content,
		  'post_status'   => 'publish',
		  'post_author'   => $post_author,
		  'post_type' 	   => 'reply',
		  'post_parent' => $post_parent
		));

		if ($post_id) {
		// insert post meta
		add_post_meta($post_id, '_bbp_forum_id', $forum_id, false);
		add_post_meta($post_id, '_bbp_topic_id', $topic_id, false);
		//add_post_meta($post_id, '_bbp_reply_to', $reply_to, false);
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
      	<div class="col-xs-12 clearfix fahk">
        <div class="col-xs-6 text-left"> <?php echo '<h1 class="threaded-title">'. get_the_title() .'</h1>'; ?> </div>
        <div class="col-xs-6 text-right">
			<button title="Expand or shrink all board replies on this page! Individual topics can be overridden." id="expand-replies" class="btn btn-sm btn-default">Hide Replies</button>
			<button title="Expand or shrink all board messages on this page! It is like clicking the more button a billeon times!" class="btn btn-sm btn-default expand-all">Expand All</button>
          <?php if ( is_user_logged_in()) { ?>
          <button id="threaded-new-message" type="button" title="Post a New Message" class="newMessage btn btn-success btn-sm pull-right">New Message</button>
          <?php } else { ?>
          <button id="threaded-new-message" onclick="lognToReply()" type="button" title="Login to post a message..." class="btn btn-success pull-right">New Message</button>
          <?php	 } ?>
        </div>
		<button id="ajax-new-message">Ajax New Message</button>
		<div id="new-message"> He there </div>
      </div>

	<?php echo '<div class="page hentry entry">'; ?>

	<?php '<div class="threaded-head"></div>'; ?>

	<?php '<div class="entry-content">' . get_the_content() ; ?>

	<?php
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
			$parentID = get_the_ID();
			$topicLink = get_page_link();
			$parent = get_the_ID();
			$parent_title = get_the_title($parent);
			$grandparent_title = get_the_title();
			$author = get_the_author_meta();
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

			$reply_count = $wpdb->get_var("SELECT COUNT(ID) FROM ".$wpdb->prefix."posts WHERE post_type = 'reply' AND post_parent = '$topic_id' AND post_status = 'publish'");
			//echo 'reply count ' . $reply_count;

			echo '<div class="well well-sm threadWell">';
				echo '<div class="topicContainer">';
					echo '<div class="full-width">';
						echo '<div class="threadAvatar">' . get_avatar( get_the_author_meta( 'ID' ), 16 ) . '</div>';
						echo '<div class="threadAuthor">' . '<a href="' . bp_core_get_user_domain($author) . '">' . get_the_author() . '</a></div>';
						echo '<div class="threadTopic">' . get_the_title() . '</div>';
					echo '</div>';
					echo '<div class="threadContent contentLess" id="threadContent_' . $postID . '">' . get_the_content() . '</div>';
					?>
						<!-- <div class="threadFooter">
			  			<div class="btn-group btn-group-xs threadButtonGroup" role="group" aria-label="..."> -->
						<button type="button" title="Click to see more/less content" class="more_button btn btn-default btn-xs" id="expandContent_<?php echo $postID; ?>">More</button>
						<?php if($reply_count > 0) { ?>
							<button type="button" title="Click to show/hide replies for this topic" alt="This topic is closed to replies" class="show-replies-button btn btn-default btn-xs">Hide Replies</button>
						<?php } ?>
						<button onclick="window.location='<?php echo $postLink; ?>'" type="button" title="Go to Topic in Forum Area" class="btn btn-default btn-xs">Open</button>

						<?php if ($post_status == 'closed'){ ?>
								<button type="button" class="btn btn-default btn-xs disabled" title="Topic Closed">Topic Closed</button>
							<?php } else {
								if ( is_user_logged_in()) { ?>
									<button type="button" id="replyPost_<?php echo $parentID; ?>" title="" onclick="replyPost_id = <?php echo 'replyPost_'.$parentID; ?>; topic_id = <?php echo $parentID; ?>; forum_id = <?php echo $forum_id; ?>;" class="replyPost btn btn-default btn-xs">Reply</button>
							<?php } else { ?>
								<button onclick="lognToReply()" type="button" title="" class="btn btn-default btn-xs">Reply</button>
							<?php }
						} ?>

						<button type="button" class="btn btn-default btn-xs"> <?php echo tk_like_buttons(); ?> </button>
						<button type="button" title="Share this topic on Twitter" class="btn btn-default btn-xs">
						  <a href="http://twitter.com/share?text=<?php echo get_the_title(); ?>&via=Ute_Hub&hashtags=GoUtes&url=<?php echo $thread_url; ?>" target="_blank"><i class="twitter"></i></a></button>
						<button type="button" title="Share this topic on Facebook" class="btn btn-default btn-xs"><a href="https://facebook.com/sharer.php?u=<?php echo $thread_url; ?>" target="_blank"><i class="facebook"></i></a></button>
						<button type="button" title="Date" class="btn btn-default btn-xs" disabled="disabled"> <?php echo get_the_date('m/d/y') . ' ' . get_the_time(); ?> </button>
						<button type="button" title="Forum" class="btn btn-default btn-xs">
						<a href="<?php echo $forum_link; ?>"><?php echo $forum_title; ?></a>
						</button>
			  			<!-- </div>
						</div> -->
						<?php

				echo '</div>';


			$args = array(
				'post_type' 		=> 'reply', // enter your custom post type
				'posts_per_page'    => '50',
				'orderby' 			=> 'menu_order',
				'order' 			=> 'ASC',
				'post_parent' 		=> $topic_id,
			);

			/////////// replies
			$loopReply = new WP_Query( $args );


			echo '<div class="replies show_reply">';


			while( $loopReply->have_posts() ): $loopReply->the_post(); global $post;
				$reply = get_the_content();
				$author = get_the_author_meta ();
				$replyLink = get_permalink();
				$replyID = get_the_ID();
				$post_parent = get_the_ID();
				$forum_id = get_post_meta( get_the_ID($replyID), '_bbp_forum_id', true);
				$topic_id = get_post_meta( get_the_ID($replyID), '_bbp_topic_id', true);
				$menu_order = $post->menu_order;

				echo '<div class="replyContainer show_reply">';
					echo '<div class="threadAvatar">' . get_avatar( get_the_author_meta( 'ID' ), 16 ) . '</div>';
					echo '<div class="threadAuthor">' . '<a href="' . bp_core_get_user_domain($author) . '">' . get_the_author() . '</a></div>';
					echo '<div class="replyContent contentLess" id="threadContent_' . $replyID . '">' . get_the_content() . '</div>';
						?>
						<button type="button" title="Click to see more/less content" alt="This topic is closed to replies" class="more_button btn btn-default btn-xs" id="expandContent_<?php echo $postID; ?>">More</button>
						<button onclick="window.location='<?php echo $postLink . '/#post-' . $replyID; ?>'" type="button" title="Go to Reply in Forum Area - Videos, Twitter, various media may work better in the main forum" class="btn btn-default btn-xs">Open</button>

						<?php if ($post_status == 'closed'){ ?>
								<button type="button" class="btn btn-default btn-xs disabled" title="Topic Closed">Topic Closed</button>
							<?php } else {
								if ( is_user_logged_in()) { ?>
									<button type="button" title="" onclick="reply_to = <?php echo $replyID; ?>; topic_id = <?php echo $topic_id; ?>; forum_id = <?php echo $forum_id; ?>; replyReply(topic_id, forum_id, reply_to)" class="btn btn-default btn-xs">Reply</button>
								<?php } else { ?>
									<button onclick="lognToReply()" type="button" title="" class="btn btn-default btn-xs">Reply</button>
								<?php }
						} ?>
						<button type="button" class="btn btn-default btn-xs"> <?php echo tk_like_buttons (); ?> </button>
						<button type="button" title="Date" class="btn btn-default btn-xs" disabled="disabled"> <?php echo get_the_date('m/d/y') . ' ' . get_the_time(); ?> </button>
	      				<?php
	 			echo '</div>';
			endwhile;
		  		echo '</div>';
				echo '</div>';
		endwhile;

	endif;


	?>
      <div class="col-sm-12 text-center">
        <?php

      $big = 999999999; // need an unlikely integer

      $pages = paginate_links( array(
          'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format' => '?paged=%#%',
          'current' => max( 1, get_query_var('page') ),
          'total' => $loop->max_num_pages,
          'type'  => 'array',
      ) );

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

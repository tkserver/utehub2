<?php

/**
 * Enqueues scripts and styles for front end.
 *
 * @since Wp Bootstrap 1.0
 *
 * @return void
 */


function tk_reply ($rid){

	$current_user_id =  get_current_user_id();
	$author_id = get_current_user_id();
	$nonce = wp_create_nonce( 'tk_forum_message' );

	$reply_id = $rid;
 	$reply   = get_post( $reply_id );


		$reply_content = apply_filters( 'the_content', $reply->post_content );
		$post_status = $reply->post_status;
		$reply_author_id = $reply->post_author;
	 	$author = get_the_author_meta( $reply_author_id );
		$parentID = get_the_ID();
	 	$replyLink = $reply->guid;
	 	$replyID = $reply->ID;
		$postLink = get_permalink();
	 	$post_parent = $reply->ID;
	 	$forum_id = get_post_meta( get_the_ID($replyID), '_bbp_forum_id', true);
	 	$topic_id = get_post_meta( get_the_ID($replyID), '_bbp_topic_id', true);
	 	//$menu_order = $post->menu_order;
	 	$avatar =  get_avatar( $reply_author_id, 42 );
	 	$timestamp = get_post_time('U', true);
	 	$time = calc_time_diff($timestamp, NULL, TRUE);
	 	$user_can_edit = 'no';
	 	if($current_user_id == $author){$user_can_edit = 'yes';}

	 	?>
	 <div class="replies show_reply">
	 	<div class="replyContainer show_reply">
	 		<div class="media-left pull-left"> <a href="#"><?php echo $avatar; ?></a></div>
	 		<div class="media-body">
	 			<div class="media-heading"><a href="<?php echo bp_core_get_user_domain(); ?>"><?php echo the_author_meta( 'display_name', $reply_author_id ); ?></a>
	 				<span class="postInfo">
	 				 &nbsp;<?php echo $time ?></span>
	 				 <div class="pull-right"><?php echo tk_like_buttons(); ?> </div>
	 			</div>
	 			<div class="replyContent contentLess" id="threadContent_<?php echo $replyID; ?>"><?php echo $reply_content; ?></div>
	 			<button type="button" title="Click to see more/less content" alt="This topic is closed to replies" class="more_button footer_button reply_more_button" id="expandContent_<?php echo $topic_id; ?>">More</button>


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
	 			<button onclick="window.location='<?php echo $postLink . '/#post-' . $replyID; ?>'" type="button" title="Go to Reply in Forum Area" class="footer_button">Open</button>
	 		</div>
	 		<div class="editor"></div>
	 	</div>
	 </div>
<?php
}


function tk_list_replies( $args = array() ) {

 	// Reset the reply depth
 	bbpress()->reply_query->reply_depth = 0;

 	// In reply loop
 	bbpress()->reply_query->in_the_loop = true;

 	$r = bbp_parse_args( $args, array(
 		'walker'       => null,
 		'max_depth'    => bbp_thread_replies_depth(),
 		'style'        => 'ul',
 		'callback'     => null,
 		'end_callback' => null,
 		'page'         => 1,
 		'per_page'     => -1
 	), 'list_replies' );

 	// Get replies to loop through in $_replies
 	$walker = new TK_Walker_Reply;
 	$walker->paged_walk( bbpress()->reply_query->posts, $r['max_depth'], $r['page'], $r['per_page'], $r );

 	bbpress()->max_num_pages            = $walker->max_pages;
 	bbpress()->reply_query->in_the_loop = false;
 }


 class TK_Walker_Reply extends Walker {

 	var $tree_type = 'reply';
 	var $db_fields = array(
 		'parent' => 'reply_to',
 		'id'     => 'ID'
 	);

 	public function start_lvl( &$output = '', $depth = 0, $args = array() ) {
 		bbpress()->reply_query->reply_depth = $depth + 1;

 		switch ( $args['style'] ) {
 			case 'div':
 				break;
 			case 'ol':
 				echo "<ol class='bbp-threaded-replies'>\n";
 				break;
 			case 'ul':
 			default:
 				echo "<ul class='tk-threaded-replies'>\n";
 				break;
 		}
 	}

 	public function end_lvl( &$output = '', $depth = 0, $args = array() ) {
 		bbpress()->reply_query->reply_depth = (int) $depth + 1;

 		switch ( $args['style'] ) {
 			case 'div':
 				break;
 			case 'ol':
 				echo "</ol>\n";
 				break;
 			case 'ul':
 			default:
 				echo "</ul>\n";
 				break;
 		}
 	}

 	public function display_element( $element = false, &$children_elements = array(), $max_depth = 0, $depth = 0, $args = array(), &$output = '' ) {

 		if ( empty( $element ) )
 			return;

 		// Get element's id
 		$id_field = $this->db_fields['id'];
 		$id       = $element->$id_field;

 		// Display element
 		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

 		// If we're at the max depth and the current element still has children, loop over those
 		// and display them at this level to prevent them being orphaned to the end of the list.
 		if ( ( $max_depth <= (int) $depth + 1 ) && isset( $children_elements[$id] ) ) {
 			foreach ( $children_elements[$id] as $child ) {
 				$this->display_element( $child, $children_elements, $max_depth, $depth, $args, $output );
 			}
 			unset( $children_elements[$id] );
 		}
 	}

 	public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {

 		// Set up reply
 		$depth++;
 		bbpress()->reply_query->reply_depth = $depth;
 		bbpress()->reply_query->post        = $object;
 		bbpress()->current_reply_id         = $object->ID;

 		// Check for a callback and use it if specified
 		if ( !empty( $args['callback'] ) ) {
 			call_user_func( $args['callback'], $object, $args, $depth );
 			return;
 		}

 		// Style for div or list element
 		if ( !empty( $args['style'] ) && ( 'div' === $args['style'] ) ) {
 			echo "<div>\n";
 		} else {
 			echo "<li class=\"tk-thread-li\">\n";
 		}

		tk_reply( $object->ID );
 	}

 	/**
 	 * @since bbPress (r4944)
 	 */
 	public function end_el( &$output = '', $object = false, $depth = 0, $args = array() ) {

 		// Check for a callback and use it if specified
 		if ( !empty( $args['end-callback'] ) ) {
 			call_user_func( $args['end-callback'], $object, $args, $depth );
 			return;
 		}

 		// Style for div or list element
 		if ( !empty( $args['style'] ) && ( 'div' === $args['style'] ) ) {
 			echo "</div>\n";
 		} else {
 			echo "</li>\n";
 		}
 	}
 }


 // Register Custom Post Type
function custom_post_type_reply() {

	$labels = array(
		'name'                  => _x( 'Replies', 'Post Type General Name', 'tk_reply' ),
		'singular_name'         => _x( 'Reply', 'Post Type Singular Name', 'tk_reply' ),
		'menu_name'             => __( 'Post Types', 'tk_reply' ),
		'name_admin_bar'        => __( 'Post Type', 'tk_reply' ),
		'archives'              => __( 'Item Archives', 'tk_reply' ),
		'attributes'            => __( 'Item Attributes', 'tk_reply' ),
		'parent_item_colon'     => __( 'Parent Item:', 'tk_reply' ),
		'all_items'             => __( 'All Items', 'tk_reply' ),
		'add_new_item'          => __( 'Add New Item', 'tk_reply' ),
		'add_new'               => __( 'Add New', 'tk_reply' ),
		'new_item'              => __( 'New Item', 'tk_reply' ),
		'edit_item'             => __( 'Edit Item', 'tk_reply' ),
		'update_item'           => __( 'Update Item', 'tk_reply' ),
		'view_item'             => __( 'View Item', 'tk_reply' ),
		'view_items'            => __( 'View Items', 'tk_reply' ),
		'search_items'          => __( 'Search Item', 'tk_reply' ),
		'not_found'             => __( 'Not found', 'tk_reply' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'tk_reply' ),
		'featured_image'        => __( 'Featured Image', 'tk_reply' ),
		'set_featured_image'    => __( 'Set featured image', 'tk_reply' ),
		'remove_featured_image' => __( 'Remove featured image', 'tk_reply' ),
		'use_featured_image'    => __( 'Use as featured image', 'tk_reply' ),
		'insert_into_item'      => __( 'Insert into item', 'tk_reply' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'tk_reply' ),
		'items_list'            => __( 'Items list', 'tk_reply' ),
		'items_list_navigation' => __( 'Items list navigation', 'tk_reply' ),
		'filter_items_list'     => __( 'Filter items list', 'tk_reply' ),
	);
	$args = array(
		'label'                 => __( 'Reply', 'tk_reply' ),
		'description'           => __( 'Reply post type', 'tk_reply' ),
		'labels'                => $labels,
		'supports'              => array( ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'reply', $args );

}
add_action( 'init', 'custom_post_type_reply', 0 );


function show_all_children($parent_id, $post_id, $current_level) {
     $top_parents    = array();
     $top_parents    = get_post_ancestors($post_id);
     $top_parents[]  = $post_id;

	$children = array(
		'post_type'  => 'reply',
		'post_parent' => $post_id,
	    	'capability_type'    => 'post',
         	'hierarchical'       => true,
         	'posts_per_page'     =>-1,

	);

     if (empty($children)) return;

     echo '<ul class="children level-'.$current_level.'-children">';

          foreach ($children as $child) {
               echo '<li';
                   if (in_array($child->ID, $top_parents))
                   {
                   echo ' class="current_page_item"';
                   }
               echo '>';

               // echo '<a href="'.get_permalink($child->ID).'">';
               // echo apply_filters('the_title', $child->post_content);
               // echo '</a>';

                    echo '<br />ID: '.$child->ID;
                    echo  '<br />Level: '.$current_level;
                    echo  '<br />Parent: '.$child->post_parent;
                    echo  '<br />Content: '.$child->post_content;

                   // now call the same function for child of this child
                   if ($child->ID && (in_array($child->ID, $top_parents)))
                   {
                        show_all_children($child->ID, $post_id, $current_level+1);
                        echo 'array fired';
                   }

               echo '</li>';
          }

     echo '</ul>';

}



function foo(){echo 'foooo';}

function wpse13669_show_all_children( $post_id_f, $current_level ) {

     // $children = get_posts( array(
     //     'post_type'          =>'reply',
     //     'capability_type'    => 'post',
     //     'hierarchical'       => true,
     //     'posts_per_page'     =>-1,
     //     'post_parent'        => $post_id_f,  //22253
     //     'order_by'           => $post_id_f,
     //     'order'              => 'ASC'
     //      )
     // );

     // //use below query for replies, above for checking via page type
     // global $wpdb;
	// //$meta_count = $wpdb->get_var( "SELECT COUNT(*) FROM wp_postmeta WHERE meta_value = $post_id_f AND meta_key = '_bbp_reply_to'" );
	// //echo '<br />Meta count: ' . $meta_count . '<br />';
	//
	// //$meta_count = 0;
	//
	// 	$children = $wpdb->get_results( "SELECT *
	// 							FROM wp_posts posts
	// 							LEFT JOIN wp_postmeta meta ON posts.ID = meta.post_id
	// 							WHERE COALESCE(meta.meta_value, posts.post_parent) = $post_id_f
	//
	// 	    "
	// 	);

	//var_dump($meta);

     //echo "<br />SELECT * FROM wp_posts WHERE post_parent = $post_id_f AND post_type = 'reply' ";
    if ( empty($children) ) return;


    echo  '<ul class="children level-'.$current_level.'-children">';
    //var_dump($children);
	     foreach ($children as $child) {

	            echo  '<li>';
	            echo  '<br />Level: '.$current_level;
	            echo  '<br />This id: '.$child->ID;
	            echo  '<br />Parent id: '.$child->post_parent;
	            //echo apply_filters( 'the_title', $child->post_content );

	        echo  '<br /><a href="'.get_permalink($child->ID).'">LINK ';
	        echo  '</a><br />';
	        echo  apply_filters('the_title', $child->post_content);

	        // now call the same function for child of this child
	        //echo 'next level '. $next_level;
	        //$post_id = $child->ID;

	       wpse13669_show_all_children( $child->ID, $current_level+1);
	        //return foo();

	        //echo testFunction();

	            echo  '</li>';

	     }
     wp_reset_query();

    echo  '</ul>';
    }



// this function snipped I found converts time to twitter style, like 1h
 function calc_time_diff($timestamp, $unit = NULL, $show_unit = TRUE) {
     $seconds = round((time() - $timestamp)); // How many seconds have elapsed
     $minutes = round((time() - $timestamp) / 60); // How many minutes have elapsed
     $hours = round((time() - $timestamp) / 60 / 60); // How many hours have elapsed
     $days = round((time() - $timestamp) / 60 / 60 / 24); // How many hours have elapsed
     $seconds_string = $seconds;
     $minutes_string = $minutes;
     $hours_string = $hours;
     $days_string = $days;
     switch($unit) {
         case "seconds": return $seconds;
             break;
         case "minutes": return $minutes;
             break;
         case "hours": return $hours;
             break;
         case "days": return $days;
             break;
         default: // No time unit specified, return the most relevant
             if($seconds < 60) { // Less than a minute has passed
                 if($seconds != 1) {
                     $seconds_string .= " now";
                 }
                 else {
                     $seconds_string .= " sec";
                 }
                 return ($show_unit) ? $seconds_string : $seconds;
             }
             elseif($minutes < 60) { // Less than an hour has passed
                 if($minutes != 1) {
                     $minutes_string .= " min";
                 }
                 else {
                     $minutes_string .= " min";
                 }
                 return ($show_unit) ? $minutes_string : $minutes;
                 ;
             }
             elseif($hours < 24) { // Less than a day has passed
                 if($hours != 1) {
                     $hours_string .= " h";
                 }
                 else {
                     $hours_string .= " h";
                 }
                 return ($show_unit) ? $hours_string : $hours;
             }
             else { // More than a day has passed
                 if($days != 1) {
                     $days_string .= " days";
                 }
                 else {
                     $days_string .= " day";
                 }
                 return ($show_unit) ? $days_string : $days;
             }
             break;
     }
 }


add_filter('show_admin_bar', '__return_false');


 function load_jquery_ui_css(){
 	//wp_enqueue_script( 'jquery-ui-datepicker' );
 	//wp_enqueue_script( 'jquery-ui-dialog' );
 	wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
 }
 add_action('wp_enqueue_scripts', 'load_jquery_ui_css');


// function add_my_js_files(){
//      wp_enqueue_script('jquery-validate-min',
//                        get_stylesheet_directory_uri() . '/js/jquery.validate.min.js',
//                        array( 'jquery' )
//                       );
//  }
//  add_action('wp_enqueue_scripts', "add_my_js_files");


// check and see if we are on localhost for the bbpress bug below
$server = $_SERVER['SERVER_NAME'];

//error_log($server);
if($server == "localhost"){
     //this gets rid of the "are you sure you want to do that?" bug in bbpress on local dev environment, but we don't want it to run on productions
     add_filter( 'bbp_verify_nonce_request_url', 'my_bbp_verify_nonce_request_url', 999, 1 );
          function my_bbp_verify_nonce_request_url( $requested_url )
     {
         return 'http://localhost:8888' . $_SERVER['REQUEST_URI'];
     }
     //error_log("The localhost hack for bbpress is running");
}

function add_jquery_effects_core_js() {
    wp_enqueue_script( 'jquery-effects-core' );
}
add_action( 'wp_enqueue_scripts', 'add_jquery_effects_core_js' );


function add_jquerydialog_js() {
     wp_enqueue_script( 'jquery-ui-dialog' );
 }
 add_action( 'wp_enqueue_scripts', 'add_jquerydialog_js' );

/* add tinymce to the theme  */
function tk_tinymce() {
     wp_enqueue_script( 'tinymce_js', includes_url( 'js/tinymce/' ) . 'wp-tinymce.php', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'tk_tinymce' );

/* add bootstrap-select to the theme  */
// function tk_bootstrap_select() {
//      wp_enqueue_script( 'script-bootstrapselect', get_template_directory_uri() . '/js/bootstrap-select.js', array('jquery'), '1.0.0', true );
// }
// add_action( 'wp_enqueue_scripts', 'tk_bootstrap_select' );


function utehubjs() {
    wp_enqueue_style( 'style-utehubjs', get_stylesheet_uri() );
    wp_enqueue_script( 'script-utehubjs', get_template_directory_uri() . '/js/utehub.js', array('jquery'), '20161230', true );
    wp_enqueue_script( 'bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
}
add_action( 'wp_enqueue_scripts', 'utehubjs' );


 /**
  * Enqueue theme style-file
  */
 function tk_add_fontawesome_stylesheet() {
     // Respects SSL, Style.css is relative to the current file
     wp_register_style( 'tkLike', plugins_url('/css/font-awesome.min.css', __FILE__) );
     wp_enqueue_style( 'tkLike' );
     }
     /**
      * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
      */
 add_action( 'wp_enqueue_scripts', 'tk_add_fontawesome_stylesheet' );



// brought in from the threaded view file...
function tk_get_forums(){

 	// WP_Query arguments
 	$args = array (
 		'post_type'              => array( 'forum' ),
 		'post_status'            => array( 'publish' ),
 		'pagination'             => false,
 		'posts_per_page' => 100	);

 	// The Query
 	$get_forums = new WP_Query( $args );

	 	// The Loop
	 	if ( $get_forums->have_posts() ) {
	 		while ( $get_forums->have_posts() ) {
	 			$get_forums->the_post();
	 			$forum_id = get_the_ID();
	 			$forum_name = get_the_title();
	 			echo '<option value="' . $forum_id . '">' . $forum_name . '</option>';
	 		}
	 	} else {
 		// no posts found
 	}

 	// Restore original Post Data
 	wp_reset_postdata();
}


// customize lost password text

function custom_registration_text( $translated_text, $text, $domain ) {

	switch ( $translated_text ) {

		case "Registering for this site is easy. Just fill in the fields below, and we'll get a new account set up for you in no time." :

			$translated_text = __( "Registering for this site is easy. Just fill in the fields below, and we'll get a new account set up for you in no time.<br /><br />

                              <strong>ATTENTION! </strong> An email confirmation will be sent to the email you provide. Make sure your email will accept mail from utehub.com. If you do not receive the email within a few minutes check your spam!

                              If you cannot find the email confirmation <a href='http://www.utehub.com/contact/'>contact a site admin</a>!

      ", 'wordpress' );

			break;

	}

	return $translated_text;

}

add_filter( 'gettext', 'custom_registration_text', 20, 3 );





// customize lost password text

function custom_lost_password_text( $translated_text, $text, $domain ) {

	switch ( $translated_text ) {

		case 'Please enter your username or email address. You will receive a link to create a new password via email.' :

			$translated_text = __( 'Please enter your username or email address. You will receive a link to create a new password via email.<br /><br />

                              <strong>ATTENTION! </strong> If you are trying to reset your password because you did not receive an email confirmation when signing

                              up for the site this will not work! Your email confirmation is likely caught in spam.

                              If you cannot find the email confirmation <a href="http://www.utehub.com/contact/">contact a site admin</a>!





      ', 'wordpress' );

			break;

	}

	return $translated_text;

}

add_filter( 'gettext', 'custom_lost_password_text', 20, 3 );







function getUserRole() {



     // lets do some banning of bad peeps

      global $current_user;

      wp_get_current_user();



      //echo 'Username: ' . $current_user->user_login . "\n";

      //echo 'User email: ' . $current_user->user_email . "\n";

      //echo 'User level: ' . $current_user->user_level . "\n";

      //echo 'User first name: ' . $current_user->user_firstname . "\n";

      //echo 'User last name: ' . $current_user->user_lastname . "\n";

      //echo 'User display name: ' . $current_user->display_name . "\n";

      //echo 'User ID: ' . $current_user->ID . "\n";



  $user_id = $current_user->ID;



  $all_meta_for_user = get_user_meta( $user_id );

  //print_r( $all_meta_for_user );



  $role = $all_meta_for_user['wp_capabilities'][0];



  //echo 'role is ' . $role;



  $profileuser = tk_get_user_to_edit($user_id);

  $user_roles = array_intersect( array_values( $profileuser->roles ), array_keys( tk_get_editable_roles() ) );

  $user_role  = reset( $user_roles );



  return $user_role;



}



function tk_get_editable_roles() {

	        $all_roles = wp_roles()->roles;



	        /**

	         * Filter the list of editable roles.

	         *

	         * @since 2.8.0

	         *

	         * @param array $all_roles List of roles.

	         */

	        $editable_roles = apply_filters( 'editable_roles', $all_roles );



	        return $editable_roles;

	}



  function tk_get_user_to_edit( $user_id ) {

	        $user = get_userdata( $user_id );



	        if ( $user )

	                $user->filter = 'edit';



	        return $user;

	}





/* wondering if I can remove this now -- it produces an error anyway *

/*function remove_mediabuttons()

{

    global $post;



    if($post->post_type == 'reply' && current_user_can('edit_post') )

    {

        remove_action( 'media_buttons', 'media_buttons' );

    }

}



add_action('admin_head', 'remove_mediabuttons');

*/





 // show user hashtag in forum under name //

 function rkk_mentionname_in_bbp() {

    $user = get_userdata( bbp_get_reply_author_id() );

        if ( !empty( $user->user_nicename ) ) {

            $user_nicename = $user->user_nicename;

            echo '<div class="user_hashtag">@'.$user_nicename.'</div>';

        }

}



add_action( 'bbp_theme_after_reply_author_details', 'rkk_mentionname_in_bbp' );

add_action( 'bbp_theme_after_topic_author_details', 'rkk_mentionname_in_bbp' );







// Disable buddy press name change //
function disable_name_change( $data ) {
     if ( 1 == $data->field_id )
          $data->field_id = false;
     return $data;
}
add_action( 'xprofile_data_before_save', 'disable_name_change' );







 /* remove forum counts from index  */



	//function remove_counts() {

	//	$args['show_topic_count'] = false;

	//	$args['show_reply_count'] = false;

	//	$args['count_sep'] = '';

	// return $args;

	//}

	//add_filter('bbp_before_list_forums_parse_args', 'remove_counts' );





 add_filter( 'bbp_get_dynamic_roles', 'ntwb_bbpress_custom_role_names' );

function ntwb_bbpress_custom_role_names() {

    return array(



        // Keymaster

        bbp_get_keymaster_role() => array(

            'name'         => 'Admin/Founder',

            'capabilities' => bbp_get_caps_for_role( bbp_get_keymaster_role() )

        ),



        // Moderator

 //       bbp_get_moderator_role() => array(

   //         'name'         => 'My Custom Moderator Role Name',

     //       'capabilities' => bbp_get_caps_for_role( bbp_get_moderator_role() )

       // ),



        // Participant

        bbp_get_participant_role() => array(

            'name'         => 'Ute Fan',

            'capabilities' => bbp_get_caps_for_role( bbp_get_participant_role() )

        ),



        // Spectator

        //bbp_get_spectator_role() => array(

          //  'name'         => 'My Custom Spectator Role Name',

           // 'capabilities' => bbp_get_caps_for_role( bbp_get_spectator_role() )

        //),



        // Blocked

 //       bbp_get_blocked_role() => array(

   //         'name'         => 'My Custom Blocked Role Name',

     //       'capabilities' => bbp_get_caps_for_role( bbp_get_blocked_role() )

       // )

    );

}



 /* This function changes outgoing mail name wordpress to Ute Hub Email System  */
 function custom_wp_mail_from( $email ) {

      $handle = 'admin';
      $find = 'http://';
      $replace = '';
      $link = get_bloginfo( 'url' );
      $domain = str_replace( $find, $replace, $link );

 	return $handle . '@' . $domain ;

 }

 add_filter( 'wp_mail_from', 'custom_wp_mail_from' );



/**

 * Register Sidebar

 */

function textdomain_register_sidebars() {



	/* Register the primary sidebar. */
	register_sidebar(
		array(
			'id' => 'sidebar-1',
			'name' => __( 'HomeRight', 'textdomain' ),
			'description' => __( 'A short description of the sidebar.', 'textdomain' ),
		)
	);

	register_sidebar(
		array(
			'id' => 'sidebar-2',
			'name' => __( 'FooterLeft', 'textdomain' ),
			'description' => __( 'A short description of the sidebar.', 'textdomain' ),
		)
	);

	register_sidebar(
		array(
			'id' => 'sidebar-3',
			'name' => __( 'FooterMiddle', 'textdomain' ),
			'description' => __( 'A short description of the sidebar.', 'textdomain' ),
		)
	);

	register_sidebar(
		array(
			'id' => 'sidebar-4',
			'name' => __( 'FooterRight', 'textdomain' ),
			'description' => __( 'A short description of the sidebar.', 'textdomain' ),
		)
	);

	register_sidebar(
		array(
			'id' => 'sidebar-5',
			'name' => __( 'ForumRight', 'textdomain' ),
			'description' => __( 'Forum sidebar.', 'textdomain' ),
		)
	);

	register_sidebar(
		array(
			'id' => 'sidebar-6',
			'name' => __( 'PageRight', 'textdomain' ),
			'description' => __( 'Standard page sidebar.', 'textdomain' ),
		)
	);

	register_sidebar(
		array(
			'id' => 'sidebar-7',
			'name' => __( 'MembersRight', 'textdomain' ),
			'description' => __( 'Members page sidebar.', 'textdomain' ),
		)
	);

	register_sidebar(
		array(
			'id' => 'sidebar-8',
			'name' => __( 'ContentHeader', 'textdomain' ),
			'description' => __( 'Above page content', 'textdomain' ),
		)
	);
}

add_action( 'widgets_init', 'textdomain_register_sidebars' );



// allows shortcodes to be put in widgets, hopefuly
add_filter('widget_text', 'do_shortcode');


function utehub_load_css() {


	//Load our custom version of Bootsrap CSS. Can easily override in a child theme.
	wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.0.0', 'all' );
	wp_enqueue_style( 'bootstrap');

     // //bootstrap custom select stuff
     // wp_register_style('bootstrap-select', get_template_directory_uri() . '/css/bootstrap-select.min.css', array(), '1.12.1', 'all' );
     // wp_enqueue_style( 'bootstrap-select');

     wp_register_style('style', get_stylesheet_directory_uri() . '/style.css', array() ,'20170115');
     wp_enqueue_style( 'style');

}
add_action( 'wp_enqueue_scripts', 'utehub_load_css' );


function cwd_wp_bootstrap_scripts_styles() {

  // Loads Bootstrap minified JavaScript file.
  //wp_enqueue_script('bootstrapjs', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', array('jquery'),'3.0.0', true );

  // Loads Bootstrap minified CSS file.
  //wp_enqueue_style('bootstrapwp', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css', false ,'3.0.0');

  // Loads our main stylesheet.

}

add_action('wp_enqueue_scripts', 'cwd_wp_bootstrap_scripts_styles');


if ( ! function_exists( 'cwd_wp_bootstrapwp_theme_setup' ) ):

  function cwd_wp_bootstrapwp_theme_setup() {

    // Adds the main menu
     register_nav_menus( array(
         'main-menu' => __( 'Main Menu', 'cwd_wp_bootstrapwp' ),
     ) );
  }

endif;

add_action( 'after_setup_theme', 'cwd_wp_bootstrapwp_theme_setup' );



require_once 'inc/nav.php';

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

register_nav_menus( array(

    'top-menu' => __( 'Top Menu', 'Ute Hub' ),

) );



add_theme_support( 'post-thumbnails' );


/*******************************************************************
* @Author: Boutros AbiChedid
* @Date:   March 20, 2011
* @Websites: http://bacsoftwareconsulting.com/
* http://blueoliveonline.com/
* @Description: Numbered Page Navigation (Pagination) Code.
* @Tested: Up to WordPress version 3.1.2 (also works on WP 3.3.1)
********************************************************************/
/* Function that Rounds To The Nearest Value.

   Needed for the pagenavi() function */

function round_num($num, $to_nearest) {

   /*Round fractions down (http://php.net/manual/en/function.floor.php)*/

   return floor($num/$to_nearest)*$to_nearest;

}

/* Function that performs a Boxed Style Numbered Pagination (also called Page Navigation).

   Function is largely based on Version 2.4 of the WP-PageNavi plugin */

function pagenavi($before = '', $after = '') {

    global $wpdb, $wp_query;
    $pagenavi_options = array();
    $pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%:');
    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['first_text'] = ('First Page');
    $pagenavi_options['last_text'] = ('Last Page');
    $pagenavi_options['next_text'] = 'Next &raquo;';
    $pagenavi_options['prev_text'] = '&laquo; Previous';
    $pagenavi_options['dotright_text'] = '...';
    $pagenavi_options['dotleft_text'] = '...';
    $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
    $pagenavi_options['always_show'] = 0;
    $pagenavi_options['num_larger_page_numbers'] = 0;
    $pagenavi_options['larger_page_numbers_multiple'] = 5;

    //If NOT a single Post is being displayed

    /*http://codex.wordpress.org/Function_Reference/is_single)*/

    if (!is_single()) {

        $request = $wp_query->request;

        //intval — Get the integer value of a variable

        /*http://php.net/manual/en/function.intval.php*/

        $posts_per_page = intval(get_query_var('posts_per_page'));

        //Retrieve variable in the WP_Query class.

        /*http://codex.wordpress.org/Function_Reference/get_query_var*/

        $paged = intval(get_query_var('paged'));

        $numposts = $wp_query->found_posts;

        $max_page = $wp_query->max_num_pages;



        //empty — Determine whether a variable is empty

        /*http://php.net/manual/en/function.empty.php*/

        if(empty($paged) || $paged == 0) {

            $paged = 1;

        }



        $pages_to_show = intval($pagenavi_options['num_pages']);

        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);

        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);

        $pages_to_show_minus_1 = $pages_to_show - 1;

        $half_page_start = floor($pages_to_show_minus_1/2);

        //ceil — Round fractions up (http://us2.php.net/manual/en/function.ceil.php)

        $half_page_end = ceil($pages_to_show_minus_1/2);

        $start_page = $paged - $half_page_start;



        if($start_page <= 0) {

            $start_page = 1;

        }



        $end_page = $paged + $half_page_end;

        if(($end_page - $start_page) != $pages_to_show_minus_1) {

            $end_page = $start_page + $pages_to_show_minus_1;

        }

        if($end_page > $max_page) {

            $start_page = $max_page - $pages_to_show_minus_1;

            $end_page = $max_page;

        }

        if($start_page <= 0) {

            $start_page = 1;

        }



        $larger_per_page = $larger_page_to_show*$larger_page_multiple;

        //round_num() custom function - Rounds To The Nearest Value.

        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;

        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;

        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;

        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);



        if($larger_start_page_end - $larger_page_multiple == $start_page) {

            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;

            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;

        }

        if($larger_start_page_start <= 0) {

            $larger_start_page_start = $larger_page_multiple;

        }

        if($larger_start_page_end > $max_page) {

            $larger_start_page_end = $max_page;

        }

        if($larger_end_page_end > $max_page) {

            $larger_end_page_end = $max_page;

        }

        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {

            /*http://php.net/manual/en/function.str-replace.php */

            /*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/

            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);

            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);

            echo $before.'<div class="pagenavi">'."\n";



            if(!empty($pages_text)) {

                echo '<span class="pages">'.$pages_text.'</span>';

            }

            //Displays a link to the previous post which exists in chronological order from the current post.

            /*http://codex.wordpress.org/Function_Reference/previous_post_link*/

            previous_posts_link($pagenavi_options['prev_text']);



            if ($start_page >= 2 && $pages_to_show < $max_page) {

                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);

                //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).

                /*http://codex.wordpress.org/Data_Validation*/

                //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.

                echo '<a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a>';

                if(!empty($pagenavi_options['dotleft_text'])) {

                    echo '<span class="expand">'.$pagenavi_options['dotleft_text'].'</span>';

                }

            }



            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {

                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {

                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);

                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';

                }

            }



            for($i = $start_page; $i  <= $end_page; $i++) {

                if($i == $paged) {

                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);

                    echo '<span class="current">'.$current_page_text.'</span>';

                } else {

                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);

                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';

                }

            }



            if ($end_page < $max_page) {

                if(!empty($pagenavi_options['dotright_text'])) {

                    echo '<span class="expand">'.$pagenavi_options['dotright_text'].'</span>';

                }

                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);

                echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a>';

            }

            next_posts_link($pagenavi_options['next_text'], $max_page);



            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {

                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {

                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);

                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';

                }

            }

            echo '</div>'.$after."\n";

        }

    }

}

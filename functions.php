<?php

/**

 * Enqueues scripts and styles for front end.

 *

 * @since Wp Bootstrap 1.0

 *

 * @return void

 */

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


// function add_jquerydialog_js() {
//      wp_enqueue_script( 'jquery-ui-dialog' );
//  }
//  add_action( 'wp_enqueue_scripts', 'add_jquerydialog_js' );

/* add tinymce to the theme  */
function tk_tinymce() {
     wp_enqueue_script( 'tinymce_js', includes_url( 'js/tinymce/' ) . 'wp-tinymce.php', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'tk_tinymce' );


function utehubjs() {
    wp_enqueue_style( 'style-utehubjs', get_stylesheet_uri() );
    wp_enqueue_script( 'script-utehubjs', get_template_directory_uri() . '/js/utehub.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.0.0', true );
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


	// Load our custom version of Bootsrap CSS. Can easily override in a child theme.
	wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.0.0', 'all' );
	wp_enqueue_style( 'bootstrap');

     wp_register_style('style', get_stylesheet_directory_uri() . '/style.css', array() ,'2.5');
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





//if ( function_exists('register_sidebars') )



//  register_sidebars(7);



//  The function below adds a login/logout to the menu

//function add_login_logout_link($items, $args)

//{

//  if(is_user_logged_in())

//  {

//    $newitems = '<li><a title="Logout" href="'. wp_logout_url('index.php') .'">Logout</a></li>';

//    $newitems .= $items;

//  }

//  else

//  {

//    $newitems = '<li><a title="Login" href="'. wp_login_url('index.php') .'">Login</a></li>';

//    $newitems .= $items;

//  }

//  return $newitems;

//}

//add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);





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

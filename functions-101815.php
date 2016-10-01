<?php 
/**
 * Enqueues scripts and styles for front end.
 *
 * @since Wp Bootstrap 1.0
 *
 * @return void
 */
 
 


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




 
 /* This function changes outgoing mail from wordpress@utehub.com to admin@utehub.com  */
 function custom_wp_mail_from( $email ) {
     $handle = 'admin';
	$find = 'http://www.'; 
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
		
	
	
	
	
}
add_action( 'widgets_init', 'textdomain_register_sidebars' );


// allows shortcodes to be put in widgets, hopefuly
add_filter('widget_text', 'do_shortcode');



function cwd_wp_bootstrap_scripts_styles() {
  // Loads Bootstrap minified JavaScript file.
  wp_enqueue_script('bootstrapjs', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', array('jquery'),'3.0.0', true );
  // Loads Bootstrap minified CSS file.
  wp_enqueue_style('bootstrapwp', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css', false ,'3.0.0');
  // Loads our main stylesheet.
  wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', array('bootstrapwp') ,'1.0');
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
    'top-menu' => __( 'Top Menu', 'Saint Sophia School' ),
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

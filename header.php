<?php

/**

 * Default Header

 *

 * @package WordPress

 * @subpackage Wp_Bootstrap

 * @since Wp Bootstrap 1.0

 *

 */



 // Reporting E_NOTICE can be good too (to report uninitialized

// variables or catch variable name misspellings ...)

//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);



  //this is for banning

  if ( is_user_logged_in()) {

    $user_role = getUserRole();

  }



?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"><!--formatted-->



<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta property="fb:admins" content="TheGolfSpace" />

<meta property='fb:app_id' content='165678293812098'>

<meta property="og:title" content="<?php bloginfo('name'); ?>" />

<meta property="og:type" content="website" />

<meta property="og:image" content="http://www.utehub.com/wp-content/uploads/2015/09/UteHub-500x500.png" /><!--formatted-->

<meta property="og:image" content="http://www.utehub.com/wp-content/uploads/2016/08/pac12pickem1.png" /><!--formatted-->

<meta property="og:url" content="http://www.utehub.com" />

<meta property="og:site_name" content="Ute Hub" /><!--formatted-->

<meta property="og:image" content="http://ia.media-imdb.com/images/rock.jpg" />

<meta property="og:description" content="<?php bloginfo('description'); ?>" />

<meta name="description" content="<?php bloginfo('description'); ?>">

<meta name="keywords" content="Utah Utes, Utah Football, UteFans.net, Utah sports forum, UtahBy5, Utah Utes Forum, Ute Fan, Utes, University of Utah, Utah Athletics, Pac-12, pac-12 sports, Runnin Utes, Kyle Whittingham, Larry K, Jakob Poeltl, Andre Miller, Andrew Bogut, Huntsman Center, Rice Eccles Stadium, Utah Gymnastics">

<meta name="author" content="Tony Korologos">

<link rel="image_src" href="http://www.utehub.com/wp-content/uploads/2015/09/UteHub-500x500.png"><!--formatted-->



<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-57x57.png">

<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-60x60.png">

<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-72x72.png">

<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-76x76.png">

<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-114x114.png">

<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-120x120.png">

<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-144x144.png">

<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-152x152.png">

<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-180x180.png">

<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/images/android-icon-192x192.png">

<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/images/favicon-32x32.png">

<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/images/favicon-96x96.png">

<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/images/favicon-16x16.png">

<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/images/manifest.json">

<meta name="msapplication-TileColor" content="#ffffff">

<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/ms-icon-144x144.png">

<meta name="theme-color" content="#ffffff">

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/ute-hub_font.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/editor.css">



<?php

  // Fires the 'wp_head' action and gets all the scripts included by wordpress, wordpress plugins or functions.php

  // using wp_enqueue_script if it has $in_footer set to false (which is the default)

  wp_head(); ?>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!--[if lt IE 9]>

    <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>

    <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>

  <![endif]-->

  <?php if ( is_admin_bar_showing() ) {$headerClass = "header-logged-in";}?>

  <?php if ( !is_admin_bar_showing() ) {$headerClass = "navbar-fixed-top";}?>

  <?php



  if ( is_user_logged_in()) {

    if ($user_role === "bbp_blocked"){

      //echo " Access Denied";

      exit;



    }

  }

  ?>



</head>

<body <?php body_class(); ?>>



<div class="container-fluid tkHeader <?php if ( is_admin_bar_showing() ) { echo $headerClass; } ?> containerShadow" >

  <div class="container containerShadow">

    <div class="row headerNav containerShadow">

      <div class="col-md-3 headerZIndex"><a href="<?php echo get_site_url(); ?>" title="Ute Hub Home"><img alt="Ute Hub Logo" id="headerImage" src="<?php echo get_template_directory_uri(); ?>/images/HeaderLogo_trans.png"></a></div>



      <div class="col-md-9">

        <nav class="navbar navbar-default navbar-right" role="navigation">

          <!-- Mobile display -->

          <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>

          </div>



          <!-- Collect the nav links for toggling -->

          <?php // Loading WordPress Custom Menu

                        wp_nav_menu( array(

                           'container_class' => 'collapse navbar-collapse navbar-ex1-collapse',

                           'menu_class'      => 'nav navbar-nav',

                           'menu_id'         => 'main-menu',

                           'walker'          => new Cwd_wp_bootstrapwp_Walker_Nav_Menu()

                       ) );

                     ?>

        </nav>

      </div>

    </div>

  </div>

  </div>

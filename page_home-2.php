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

/* Template Name: Home Page V2*/



	// Gets page_home.php

	get_header();



	 

	 ?>



  <div class="container"> 

  <div class="row well containerShadow">

      <div class="col-md-7 col-lg-8">

          <div class="row">

          <div class="col-xs-12 well well-sm well-square">

          	<h1 id="homeH1" align="center">Welcome to Ute Hub</h1>

          	<h4 id="homeH4" align="center">University of Utah Ute Fan Community and Forum</h4>



            

            	<div class="indexFooter"><span class="indexPostDetails">

                    	<a class="indexLink" href="<?php echo get_site_url(); ?>/recent-posts/">Latest Posts</a> | 

                    	<a class="indexLink" href="<?php echo get_site_url(); ?>/forums/">Forum Index</a> | 

                    	<a class="indexLink" href="<?php echo get_site_url(); ?>/activity/">Latest Activity</a> |

                    	<a class="indexLink" href="<?php echo get_site_url(); ?>/members/">Member List</a> |

                    	<a class="indexLink" href="<?php echo get_site_url(); ?>/chat/">Chat</a>

                    	

                         </span><span class="indexPostLatest"></span>

          	</div>

   

          </div>

          

          

	<?php if ( is_active_sidebar( 'sidebar-8' ) ) : ?>

                 <?php dynamic_sidebar( 'sidebar-8' ); ?>

    <?php endif; ?>

             

             

          </div>

          <div class="row">

          <div class="col-xs-12 col-lg-6 well well-sm well-square">

               <!-- Carousel

                   ================================================== -->

                       <div id="myCarousel" class="carousel slide" data-ride="carousel"> 

                         <!-- Indicators -->

                         <ol class="carousel-indicators">

                           <li data-target="#myCarousel" data-slide-to="0" class="active"></li>

                           <li data-target="#myCarousel" data-slide-to="1"></li>

                           <li data-target="#myCarousel" data-slide-to="2"></li>

                       </ol>

               

               

  

                         

                                        <div class="carousel-inner">



                           <div class="item active"> <a href="http://www.utehub.com/forums/">

                            <img src="http://www.utehub.com/wp-content/uploads/2015/11/Untitled-11.jpg" alt="college football cheerleader Utah Utes">

                             <div class="container">

                               <div class="carousel-caption">

                                 <p style="text-align:center"><span class="tkShadowText"></span></p>

                               </div>

                             </div>

                             </a>

                           </div>

               

                           <div class="item"> <a href="http://www.utehub.com/forums">

                            <img src="http://www.utehub.com/wp-content/uploads/2015/11/DSC026741.jpg" alt="Second slide">

                             <div class="container">

                               <div class="carousel-caption">

                                 <p style="text-align:center"><span class="tkShadowText"></span></p>

                               </div>

                             </div>

                             </a>

                            </div>

                           

               

               

                           <div class="item"> <a href="http://www.utehub.com/recent-posts/">

                            <img src="http://www.utehub.com/wp-content/uploads/2015/09/Utah_vs_Utah_State_2015-06.jpg" alt="Fifth slide">

                             <div class="container">

                               <div class="carousel-caption">

                                 <p style="text-align:center"><span class="tkShadowText"></span></p>

                               </div>

                             </div>

                             </a>

                            </div>

               

               

                         </div>

                         <a class="left carousel-control" href="#myCarousel" data-slide="prev">

                         <span class="glyphicon glyphicon-chevron-left"></span></a> 

                         <a class="right carousel-control" href="#myCarousel" data-slide="next">

                         <span class="glyphicon glyphicon-chevron-right"></span></a> 

                       </div>

                       <!-- /.carousel --> 

          </div>

          <div class="col-xs-12 col-lg-6 well well-sm well-square">

			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

               <!-- Ute Hub 320x240 -->

               <ins class="adsbygoogle"

                    style="display:inline-block;width:320px;height:240px"

                    data-ad-client="ca-pub-0115173050648220"

                    data-ad-slot="9702261801"></ins>

               <script>

               (adsbygoogle = window.adsbygoogle || []).push({});

               </script>

          </div>

          </div>

          <div class="row">

          <div class="col-xs-12 col-lg-12 well well-sm well-square">

              	<div class="indexCategoryThumb"><img src="http://www.utehub.com/wp-content/uploads/2015/10/Utah_Black_Helmet-sm.png"></div>

      		<div class="indexTitle"><h1><a class="indexLink" href="http://www.utehub.com/forums/forum/sports/">Ute Fan Forums</a></h1></div>

          		<div class="indexFooter"><span class="indexPostDetails">

                    	<a  class="indexLink" href="http://www.utehub.com/forums/forum/sports/football/" title="University of Utah Football Discussion Board">Utah Football</a> | 

                         <a  class="indexLink" href="http://www.utehub.com/forums/forum/sports/mbb/" title="University of Utah Runnin' Utes Basketball Discussion Board">Runnin' Utes Basketball</a> | 

                         <a  class="indexLink" href="http://www.utehub.com/forums/forum/sports/">Other Sports</a> | 

                         <a  class="indexLink" href="http://www.utehub.com/forums/forum/sports/pac12/">Pac-12</a>

                         </span><span class="indexPostLatest"></span>

                    </div>

      	</div>

          </div>

          <div class="row">

          <div class="col-xs-12 col-lg-12 well well-sm well-square">

      	<div class="indexCategoryThumb"><img src="http://www.utehub.com/wp-content/uploads/2015/10/microphone.png"></div>

      		<div class="indexTitle"><h1><a class="indexLink" href="http://www.utehub.com/forums/">Other Forums</a></h1></div>

          		<div class="indexFooter"><span class="indexPostDetails">

                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/professional-sports/">Pro Sports</a> | 

                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/general-topics/">General</a> | 

                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/hubinfo/">Ute Hub</a> | 

                    	<a class="indexLink" href="http://www.utehub.com/forums/forum/byutds/">Rivalry</a>

                         </span><span class="indexPostLatest"></span>

                     </div>

      	</div>

          </div>

          <div class="row">

               <div class="col-xs-12 col-md-6 well well-sm well-square text-center">

                    <a href="http://www.utehub.com/utah-football-schedule/"><img src="http://www.utehub.com/wp-content/uploads/2015/10/Utah_Black_Helmet-sm.png">2015 Utah Football Schedule</a>

               </div>

               <div class="col-xs-12 col-md-6 well well-sm well-square text-center">

                    <a href="http://www.utehub.com/pac-12-football-standings/"><img src="http://www.utehub.com/wp-content/uploads/2015/11/Pac-12-logo-50x50.png">Pac-12 Football Standings</a>

               </div> 

          </div>   

          </div>

           <div class="col-md-5 col-lg-4">

             <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

             <div id="secondary" class="sidebar-container" role="complementary">

               <div class="widget-area">

                 <?php dynamic_sidebar( 'sidebar-1' ); ?>

               </div>

               <!-- .widget-area --> 

             </div>

             <!-- #secondary -->

             <?php endif; ?>

           </div>

      </div>

<?php



	// Gets footer.php

	get_footer(); 

?>
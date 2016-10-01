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

/* Template Name: Home Page*/



	// Gets page_home.php

	get_header();

	 

	 ?>



  <div class="container"> 

  <div class="row well containerShadow">

      <div class="col-md-7 col-lg-8 well">

        <div class="col-xs-12 well">

          <h1 id="homeH1" align="center">Welcome to Ute Hub</h1>

          <h4 id="homeH4" align="center">University of Utah Ute Fan Community and Forum</h4>

          <div class="btn-group center" role="group" aria-label="...">

<!--            <button type="button" class="btn btn-default">

            <a href="/forum/">Forum</a>

            </button>-->

            <button type="button" class="btn btn-default">

            <a href="<?php echo get_site_url(); ?>/recent-posts/">Latest Posts</a>

            </button>

            <button type="button" class="btn btn-default">

            <a href="<?php echo get_site_url(); ?>/activity/">Latest Activity</a>

            </button>

          </div>

        </div>

<!--     <div class="col-xs-12 well">

          <table width="100%" style="background-color:white;">

            <tbody>

              <tr>

                <td align="center"><img src="http://www.utehub.com/wp-content/uploads/2015/10/Utah_Utes_Helmet_Red_150px.png" width="80"><br />

                  Utah Utes<br>

                  7-1, 4-1 Pac-12</td>

                <td align="center">at</td>

                <td align="center"><img src="http://www.utehub.com/wp-content/uploads/2015/11/Washington_helmet.gif" width="80"><br />

          

                  <br>

                4-4, 2-3 Pac-12</td>

              </tr>

              <tr>

               <td align="center" colspan="3">Saturday, 11/7/15 - 5:30PM MST<br />Salt Lake City, UT<br />TV: FOX</td>

              </tr>

            </tbody>

          </table>

	</div> -->       

        <!-- Carousel

    ================================================== -->

        <div id="myCarousel" class="carousel slide" data-ride="carousel"> 

          <!-- Indicators -->

          <ol class="carousel-indicators">

            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>

            <li data-target="#myCarousel" data-slide-to="1"></li>

            <li data-target="#myCarousel" data-slide-to="2"></li>

        <li data-target="#myCarousel" data-slide-to="3"></li>

        <li data-target="#myCarousel" data-slide-to="4"></li>

          </ol>





          <div class="carousel-inner">

          

          

          

          



            <div class="item active"> <a href="http://www.utehub.com/forums/"><img src="http://www.utehub.com/wp-content/uploads/2015/11/Utah_At_Arizona.jpg" alt="college football Utah Utes">

              <div class="container">

                <div class="carousel-caption">

                  <p style="text-align:center"><span class="tkShadowText"></span></p>

                </div>

              </div>

              </a>

            </div>



            <div class="item"> <a href="http://www.utehub.com/forums/"> <img src="http://www.utehub.com/wp-content/uploads/2015/11/Untitled-1.jpg" alt="college football cheerleader Utah Utes">

              <div class="container">

                <div class="carousel-caption">

                  <p style="text-align:center"><span class="tkShadowText"></span></p>

                </div>

              </div>

              </a>

            </div>



            <div class="item"> <a href="http://www.utehub.com/forums"> <img src="http://www.utehub.com/wp-content/uploads/2015/11/DSC02674.jpg" alt="Second slide">

              <div class="container">

                <div class="carousel-caption">

                  <p style="text-align:center"><span class="tkShadowText"></span></p>

                </div>

              </div>

              </a> </div>

            





            <div class="item"> <a href="http://www.utehub.com/recent-posts/"> <img src="http://www.utehub.com/wp-content/uploads/2015/10/blackout.jpg" alt="Fifth slide">

              <div class="container">

                <div class="carousel-caption">

                  <p style="text-align:center"><span class="tkShadowText"></span></p>

                </div>

              </div>

              </a> </div>



	





          </div>

          <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a> </div>

        <!-- /.carousel --> 

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

    

  </div>

<?php



	// Gets footer.php

	get_footer(); 

?>
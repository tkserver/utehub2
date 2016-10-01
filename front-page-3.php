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
/* Template Name: Front Page 2*/

	// Gets header.php
	get_header();
	 
	 ?>
          
                <div class="row">
        <div class="col-md-8">

 <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>        
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="<?php echo get_template_directory_uri(); ?>/images/carousel0.jpg" alt="First slide">
        </div>
        <div class="item">
          <img src="<?php echo get_template_directory_uri(); ?>/images/carousel1.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1><span class="tkShadowText">Air Mail</span></h1>
              <p style="text-align:center"><span class="tkShadowText">Wave down at your friends' drives as you fly over them...</span></p>
              <p style="text-align:center"><a class="btn btn-danger btn-lg" href="#" role="button">Book your flight  &raquo;</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="<?php echo get_template_directory_uri(); ?>/images/carousel2.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1><span class="tkShadowText">Don't fear the fairway</span></h1>
              <p style="text-align:center"><span class="tkShadowText">Swing with confidence. Hit more fairways.</span></p>
              <p style="text-align:center"><a class="btn btn-danger btn-lg" href="#" role="button">Buy now  &raquo;</a></p>
            </div>
          </div>
        </div> 
        <div class="item">
          <img src="<?php echo get_template_directory_uri(); ?>/images/carousel4.jpg" alt="Fifth slide">
          <div class="container">
            <div class="carousel-caption">
              <h1><span class="tkShadowText">Tee it high, let it fly...</span></h1>
              <p style="text-align:center"><span class="tkShadowText">More distance.  Better accuracy. Lower scores...</span></p>
              <p style="text-align:center"><a class="btn btn-danger btn-lg" href="#" role="button">Fly now  &raquo;</a></p>
            </div>
          </div>
        </div>
        
        </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->
</div>
        <div class="col-md-4 frontPage">
          <h2>Shop</h2>
          <p><img height="230" class="alignright" src="http://localhost/tornadotee.com/wp-content/uploads/2014/03/tt-white-200-500x500.jpg">Don't wait any longer. Take advangage of increased distance and accuracy from this revolutionary high performance golf tee!</p>
          
          <p><a class="btn btn-danger btn-lg" href="http://www.tornadotee.com/shop" role="button">Buy Now! &raquo;</a></p>
        </div>
</div>
      
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4 frontPage">
          <h2>Revolutionary Golf Tee</h2>
          <p>Tornado Tee is a unique, scientifically designed, high performance golf tee. The patent pending design of the Tornado Tee provides maximum energy transfer from the club head to the ball.</p>
          <p><a class="btn btn-default" href="?page_id=2" role="button">More &raquo;</a></p>
       </div>
       
      <div class="col-md-4 frontPage">
      	<h2>Latest News</h2>
			<ul>
				<?php
					$recent_posts = wp_get_recent_posts();
					foreach( $recent_posts as $recent ){
						echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a> </li> ';
					}
				?>
			</ul>
        </div>

        <div class="col-md-4 frontPage">
          <h2>Social</h2>
          <img src="<?php echo get_template_directory_uri(); ?>/images/facebook_icon.png" alt="Tornado Tee Facebook">
          <img src="<?php echo get_template_directory_uri(); ?>/images/twitter_icon.png" alt="Tornado Tee Twitter">
          <img src="<?php echo get_template_directory_uri(); ?>/images/youtube_icon.png" alt="Tornado Tee YouTube">
        </div>
      </div>

      <!-- /END THE FEATURETTES -->
      
      <?php
	 
	 
	 
	 
	 
	 
	 
	// Gets footer.php
	get_footer(); 
?>
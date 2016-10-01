<?php 
/**
 * Default Footer
 *
 * @package WordPress
 * @subpackage Wp_Bootstrap
 * @since Wp Bootstrap 1.0
 *
 */
 
// Gets all the scripts included by wordpress, wordpress plugins or functions.php 
// using wp_enqueue_script if it has $in_footer set to true
?>
<div class="row footerWell containerShadow">
      <!-- Example row of columns -->
      <div class="container">
      <div class="row">

       
<div class="row-fluid">

  <div class="col-lg-4 col-xs-12 col-sm-12 col-md-4">
  	<?php include(TEMPLATEPATH."/footer-left-sidebar.php");?>
  </div>
  <div class="col-lg-4 col-xs-12 col-sm-12 col-md-4">
  	<?php include(TEMPLATEPATH."/footer-middle-sidebar.php");?>
  </div>
  <div class="col-lg-4 col-xs-12 col-sm-12 col-md-4">
  	<?php include(TEMPLATEPATH."/footer-right-sidebar.php");?>
  </div>
  
</div>

        
        
      </div>
      </div>
</div> <!-- // .container -->
<?php wp_footer(); ?>
</body>
</html>
<?php
/**
 * Taxonomy API: Walker_Category class
 *
 * @package WordPress
 * @subpackage Template
 * @since 4.4.0
 */

/**
 * Core class used to create an HTML list of categories.
 *
 * @since 2.1.0
 *
 * @see Walker
 */
 class TK_Walker_Reply extends Walker {

     /**
 	* @see Walker::$tree_type
 	*
 	* @since bbPress (r4944)
 	*
 	* @var string
 	*/
     var $tree_type = 'reply';

     /**
 	* @see Walker::$db_fields
 	*
 	* @since bbPress (r4944)
 	*
 	* @var array
 	*/
     var $db_fields = array(
 	    'parent' => 'reply_to',
 	    'id'     => 'ID'
     );

     /**
 	* @see Walker::start_lvl()
 	*
 	* @since bbPress (r4944)
 	*
 	* @param string $output Passed by reference. Used to append additional content
 	* @param int $depth Depth of reply
 	* @param array $args Uses 'style' argument for type of HTML list
 	*/
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
 			    echo "<ul class='bbp-threaded-replies'>\n";
 			    break;
 	    }
     }

     /**
 	* @see Walker::end_lvl()
 	*
 	* @since bbPress (r4944)
 	*
 	* @param string $output Passed by reference. Used to append additional content
 	* @param int $depth Depth of reply
 	* @param array $args Will only append content if style argument value is 'ol' or 'ul'
 	*/
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

     /**
 	* @since bbPress (r4944)
 	*/
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

     /**
 	* @see Walker:start_el()
 	*
 	* @since bbPress (r4944)
 	*/
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
 		    echo "<li>\n";
 	    }

 	    bbp_get_template_part( 'loop', 'single-reply' );
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

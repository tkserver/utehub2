<?php

     function tk_reply_loop($topic_id, $current_user_id, $post_status) {

          global $wpdb;

          $args = array(
               'post_type' 		=> 'reply', // enter your custom post type
               'posts_per_page'    => '50',
               'orderby' 		=> 'post_parent',
               'post_parent' 		=> $topic_id,
               // 'meta_key' 		=> '_bbp_reply_to',
               // 'meta_key' => '_bbp_reply_to',
               //'orderby' => 'meta_value_num',

               //'orderby' => 'meta_key',
               'order' => 'DESC',
               // 'meta_query' => array(
               //     'relation' => 'OR',
               //     array(
               //         'key'=>'_bbp_reply_to',
               //         'compare' => 'EXISTS'
               //     ),
               //     array(
               //         'key'=>'_bbp_reply_to',
               //         'compare' => 'NOT EXISTS'
               //     )
               // ),



          );

          $loopReply = new WP_Query( $args );

          ////////  REPLY LOOP /////////////////////////////////////////////////////////

          while( $loopReply->have_posts() ): $loopReply->the_post(); global $post;
          $reply = apply_filters('the_content', get_the_content());
          $author = get_the_author_meta( 'ID' );
          $replyLink = get_permalink();
          $replyID = get_the_ID();
          $post_parent = get_the_ID();
          $forum_id = get_post_meta( get_the_ID($replyID), '_bbp_forum_id', true);
          $topic_id = get_post_meta( get_the_ID($replyID), '_bbp_topic_id', true);
          $replied_to = get_post_meta( get_the_ID(), '_bbp_reply_to', true);
          //$menu_order = $post->menu_order;
          $menu_order = $wpdb->get_var( "SELECT menu_order FROM $wpdb->posts WHERE ID=" . $replyID  );
          $avatar = get_avatar( get_the_author_meta( 'ID' ), 42 );
          $timestamp = get_post_time('U', true);
          $time = calc_time_diff($timestamp, NULL, TRUE);
          $user_can_edit = 'no';
          if($current_user_id == $author){$user_can_edit = 'yes';}
          //$reply_position = bbp_reply_position($replyID);
          $reply_position = bbp_get_reply_position( $replyID, $topic_id );

          $the_meta = the_meta($replyID);
?>



     <div class="replies show_reply">
     <div class="replyContainer show_reply" data-reply-to="<?php echo $replied_to; ?>" data-reply-id="<?php echo $replyID; ?>">
          <div class="media-left pull-left"> <a href="#"><?php echo $avatar; ?></a></div>
          <div class="media-body">
               <div class="media-heading"><a href="<?php echo bp_core_get_user_domain($author); ?>"><?php echo get_the_author(); ?></a>
                    <span class="postInfo">
                    &nbsp;<?php echo $time ?></span>
                    <div class="pull-right"><?php $replied_to; ?>Replied To: <?php echo $replied_to; ?> Menu Order: <?php echo $menu_order; ?> Current ID: <?php echo $replyID; ?> <?php echo tk_like_buttons(); ?> </div>
               </div>
               <div class="replyContent contentLess" id="threadContent_<?php echo $replyID; ?>"><?php echo $reply; ?></div>
               <button type="button" title="Click to see more/less content" alt="This topic is closed to replies" class="more_button footer_button reply_more_button" id="expandContent_<?php echo $postID; ?>">More</button>


                    <?php if ($post_status == 'closed'){ ?>
                         <button type="button" class="footer_button disabled" title="Topic Closed">Topic Closed</button>
                    <?php } else {
                         if ( is_user_logged_in()) { ?>
                              <button type="button" id="replyPost_<?php echo $parentID; ?>"
                                   data-nonce="<?php echo $nonce; ?>"
                                   data-task="replyPost"
                                   data-reply-id="<?php echo $replyID; ?>"
                                   data-menu-order="<?php echo $menu_order; ?>"
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

<?php endwhile; ?> <!-- ends the while there is a reply loop -->

<?php

};

?>

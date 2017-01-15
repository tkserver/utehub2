<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */
//echo '<br />Post id '. $post->ID;

//echo '<br /> bbp_the_reply ' . bbp_reply_id();
echo 'Object id is  '. $object->ID;

$reply_id = bbp_reply_id();
 $post_status = get_post_status();
 $current_user_id =  get_current_user_id();

 $args = array(
 	'post_type' 		=> 'reply', // enter your custom post type
 	'posts_per_page'    => '1',
 	'orderby' 		=> 'menu_order',
 	'order' 			=> 'ASC',
 	'post_parent' 		=> $object->ID,
 );
 $loopReply = new WP_Query( $args );

 ////////  REPLY LOOP /////////////////////////////////////////////////////////

$loopReply->the_post(); global $post;
 	$reply = apply_filters('the_content', get_the_content());
 	$author = get_the_author_meta( 'ID' );
 	$replyLink = get_permalink();
 	$replyID = get_the_ID();
 	$post_parent = get_the_ID();
 	$forum_id = get_post_meta( get_the_ID($replyID), '_bbp_forum_id', true);
 	$topic_id = get_post_meta( get_the_ID($replyID), '_bbp_topic_id', true);
 	//$menu_order = $post->menu_order;
 	$avatar = get_avatar( get_the_author_meta( 'ID' ), 42 );
 	$timestamp = get_post_time('U', true);
 	$time = calc_time_diff($timestamp, NULL, TRUE);
 	$user_can_edit = 'no';
 	if($current_user_id == $author){$user_can_edit = 'yes';}

 	?>
 <div class="replies show_reply">
 	<div class="replyContainer show_reply">
 		<div class="media-left pull-left"> <a href="#"><?php echo $avatar; ?></a></div>
 		<div class="media-body">
 			<div class="media-heading"><a href="<?php echo bp_core_get_user_domain($author); ?>"><?php echo get_the_author(); ?></a>
 				<span class="postInfo">
 				 &nbsp;<?php echo $time ?></span>
 				 <div class="pull-right"><?php echo tk_like_buttons(); ?> </div>
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

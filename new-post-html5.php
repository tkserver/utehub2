<div id="dialog" title="New Message">
    <h1 id="h1_new_message" class="pull-left">Post New Message</h1>
    <form id="reply-post" name="new-post" method="post" action="<?php echo $_SERVER["REQUEST_URI"] ?>">
          <label class="hide_on_reply" for="bbp_topic_title"><?php printf( __( 'Topic Title (Maximum Length: %d):', 'bbpress' ), bbp_get_title_max_length() ); ?></label>
          <br />
          <input class="form-control" type="text" id="bbp_topic_title" value="<?php bbp_form_topic_title(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="50" name="post_title" maxlength="<?php bbp_title_max_length(); ?>" />
          <p class="hide_on_reply">
            <label class="hide_on_reply" for="bbp_forum_id">
              <?php _e( 'Forum:', 'bbpress' ); ?>
            </label>
            <br />
            <?php
              bbp_dropdown( array(
                   'show_none' => __( '(No Forum)', 'bbpress' ),
                   'selected'  => bbp_get_form_topic_forum()
                             ) );
                        ?>
          </p>
        <!-- forum select list) -->
        <?php
            $content = '';
            $editor_id = "post_content";
        wp_editor( $content, $editor_id); ?>

        <input type="hidden" name="topic_id" id="topic_id" value="<?php if(isset($topic_id)){echo $topic_id;} ?>">
        <input type="hidden" name="post_parent" id="post_parent" value="<?php if(isset($parentID)){echo $parentID;} ?>">
        <input type="hidden" name="bbp_reply_to" id="bbp_reply_to" value="">
        <input type="hidden" name="post_author" id="post_author" value="<?php $post_author = get_current_user_id(); echo $post_author; ?>">
        <input type="hidden" name="forum_id" id="forum_id" value="<?php echo $forum_id; ?>">
        <input type="hidden" name="task" id="postTask" value="">
        <?php wp_nonce_field('tk_forum_message'); ?>
        <div class="submit-header">
            <button type="submit" id="bbp_reply_submit" name="bbp_reply_submit" class="btn btn-sm btn-default btn-success pull-right">Submit</button>
            <button type="button" class="btn btn-default btn-warning btn-sm pull-right" onclick="cancelPost()">Cancel</button>
        </div>
      </form>
</div>

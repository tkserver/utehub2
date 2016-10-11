<div id="reply-reply" title="New Message">
    <form id="reply-post" name="new-post" method="post" action="<?php echo $_SERVER["REQUEST_URI"] ?>">
    <div class="submit-header">
        <h1 id="h1_new_message" class="pull-left">Post New Reply!!!</h1>
        <button type="submit" id="bbp_reply_submit" name="bbp_reply_submit" class="btn btn-sm btn-default btn-success pull-right">Submit</button>
        <button type="button" class="cancelPost btn btn-default btn-warning btn-sm pull-right" onclick="cancelPost()">Cancel</button>
    </div>
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

          <?php $content = '';
                     $editor_id = 'reply_post_content';
                     $settings =   array(
                         'wpautop' => false, // use wpautop?
                         'media_buttons' => true, // show insert/upload button(s)
                         'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
                          'name' => 'post_content',
                         'textarea_rows' => 8, // rows="..."
                         'tabindex' => '',
                         'editor_css' => '', //  extra styles for both visual and HTML editors buttons,
                         'editor_class' => 'form-control', // add extra class(es) to the editor textarea
                         'teeny' => false, // output the minimal editor config used in Press This
                         'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
                         'tinymce' => false, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                         'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                     );
                ?>
          <?php wp_editor( $content, $editor_id, $settings = array() ); ?>
        <!--                    <p>
                  <input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe" tabindex="103">
                  <label for="bbp_topic_subscription"> Notify me of follow-up replies via email </label>
                </p>-->
        <input type="hidden" name="topic_id" id="topic_id" value="<?php if(isset($topic_id)){echo $topic_id;} ?>">
        <input type="hidden" name="post_parent" id="post_parent" value="<?php if(isset($parentID)){echo $parentID;} ?>">
        <input type="hidden" name="bbp_reply_to" id="bbp_reply_to" value="">
        <input type="hidden" name="post_author" id="post_author" value="<?php $post_author = get_current_user_id(); echo $post_author; ?>">
        <input type="hidden" name="forum_id" id="forum_id" value="<?php echo $forum_id; ?>">
        <!-- <input type="hidden" name="menu_order" id="menu_order" value="<?php echo $menu_order; ?>"> -->
        <input type="hidden" name="task" id="postTask" value="">
        <!--<input type="hidden" name="action" id="bbp_post_action" value="bbp-new-reply">-->
        <?php wp_nonce_field('tk_forum_message'); ?>

      </form>
</div>

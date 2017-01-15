<?php

if(isset($_GET['topic_id'])){$topic_id = $_GET['topic_id']; }
if(isset($_GET['post_parent'])){$post_parent = $_GET['post_parent']; }
if(isset($_GET['bbp_reply_to'])){$bbp_reply_to = $_GET['bbp_reply_to']; }
if(isset($_GET['post_author'])){$post_author = $_GET['post_author']; }
if(isset($_GET['menu_order'])){$menu_order = $_GET['menu_order']; }
if(isset($_GET['forum_id'])){$forum_id = $_GET['forum_id']; }
if(isset($_GET['replyPost_id'])){$replyPost_id = $_GET['replyPost_id']; }
if(isset($_GET['user_id'])){$user_id = $_GET['user_id']; }
if(isset($_GET['nonce'])){$nonce = $_GET['nonce']; }
if(isset($_GET['task'])){$task = $_GET['task']; }
if(isset($_GET['reply_id'])){$reply_id = $_GET['reply_id']; }
// echo '<br >topic id ' . $topic_id;
// echo '<br >replyPost id ' . $replyPost_id;
// echo '<br >forum id ' . $forum_id;
// echo '<br >user id ' . $user_id;
// echo '<br >nonce id ' . $nonce;


function generateRandomString($length = 16) {
	return substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
$editor_id = generateRandomString();

?>
<script>
//alert("<?php echo $task; ?>");
	var topic_id = <?php echo $topic_id; ?>;
	var replyPost_id = <?php echo $replyPost_id; ?>;
	var forum_id = <?php echo $forum_id; ?>;
	var menu_order = <?php echo $menu_order; ?>;
	var editor_id = <?php echo $editor_id; ?>;
	var reply_id = <?php echo $reply_id; ?>;
	jQuery( document ).ready( function( $ ) {
	    tinymce.init( {
	    		selector: "#<?php echo $editor_id; ?>",
			relative_urls : false,
	     	mode : "exact",
	        	height : 240,
	        	width: "100%",
	        	elements : ".post_content",
	        	theme: "modern",
	        	skin: "lightgray",
	        	menubar : false,
	        	statusbar : false,
	        	toolbar: [ "bold italic forecolor blockquote link image code fullscreen "],
	        	plugins : "link image fullscreen code textcolor", // plugins folder in wp-includes/tinymce
	        	paste_auto_cleanup_on_paste : true,
	        	paste_postprocess : function( pl, o ) {
	          	o.node.innerHTML = o.node.innerHTML.replace( /&nbsp;+/ig, " " );
	        	}
	    } );
	} );

	// below clicks the cancel button from the editor's cancel button...
    jQuery(document).on('click', ".editor-cancel", function() {
    	jQuery('.cancel').click();
    });

	// block quote the post the user is responding to
    function updateEditor(taClass) {
	 var div_quote = "#threadContent_" + reply_id;
	 var quote = jQuery(div_quote).html();
      tinyMCE.get(taClass).setContent('<blockquote>' + quote + '</blockquote><br>My response...');
    }

    jQuery(document).ready(function() {
         jQuery( "#dialog3" ).dialog({
           autoOpen: false,
           show: {
              effect: "blind",
              duration: 1000
           },
           hide: {
              effect: "explode",
              duration: 1000
           }
         });

         jQuery( "#opener" ).on( "click", function() {
           jQuery( "#dialog3" ).dialog( "open" );
         });

    });

</script>

<form id="reply-post" name="new-post" method="post" action="">
	<div class="submit-header col-xs-12">
		<div class="col-xs-6 no-pad">
			<h2 id="h2_new_message" class="pull-left">Reply</h2>
		</div>
		<div class="col-xs-6 no-pad">
			<button type="submit" name="bbp_reply_submit" class="btn btn-sm btn-default btn-success pull-right bbp_reply_submit">Submit</button>
			<button type="button" class="editor-cancel btn btn-default btn-warning btn-sm pull-right">Cancel</button>
		</div>
	</div>

	<textarea id="<?php echo $editor_id; ?>" name='post_content'></textarea>

	<input type="hidden" name="topic_id" 		 id="topic_id" 		value="<?php if(isset($topic_id)){echo $topic_id;} ?>">
	<input type="hidden" name="post_parent" 	 id="post_parent" 		value="<?php if(isset($replyPost_id)){echo $replyPost_id;} ?>">
	<input type="hidden" name="bbp_reply_to" 	 id="bbp_reply_to" 		value="<?php if(isset($reply_id)){echo $reply_id;} ?>">
	<input type="hidden" name="post_author" 	 id="post_author" 		value="<?php if(isset($user_id)){echo $user_id;} ?>">
	<input type="hidden" name="menu_order" 	 	 id="menu_order" 		value="<?php if(isset($menu_order)){echo $menu_order;} ?>">
	<input type="hidden" name="forum_id" 		 id="forum_id" 		value="<?php if(isset($forum_id)){echo $forum_id;} ?>">
	<input type="hidden" name="bbp_forum_id" 	 id="bbp_forum_id" 		value="<?php if(isset($forum_id)){echo $forum_id;} ?>">
	<input type="hidden" name="_wpnonce" 		 id="tk_forum_message" 	value="<?php if(isset($nonce)){echo $nonce;} ?>"> <!-- the nonce -->
	<input type="hidden" name="task" 			 id="postTask" 		value="<?php if(isset($task)){echo $task;} ?>">
</form>
<button id="t1button" class="btn btn-default btn-sm pull-left" onclick="updateEditor('<?php echo $editor_id; ?>');">Reply With Quote</button>

<div id="dialog3" title="Text Editor Help">
  <p>To add a link, select the link icon and fill in the fields.</p>
  <p>To embed a Tweet, paste the tweet URL into the text area on its own line.</p>
  <p>To embed a YouTube Video, paste the video URL into the text area on its own line.</p>
  <p>To add an image, click the image icon and paste the image URL into the first field.</p>
</div>

<button class="btn btn-default btn-sm pull-left" id="opener">HELP</button>

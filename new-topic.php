<?php 

	// $editor_id = $_POST['editor_id'];

	function generateRandomString($length = 16) {
    	return substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	}

	$editor_id = generateRandomString();  // OR: generateRandomString(24)

?>

<script>

	var editor_id = <?php echo $editor_id; ?>;
	jQuery( document ).ready( function( $ ) {
	    tinymce.init( {
	    	selector: "#<?php echo $editor_id; ?>",
	        mode : "exact",
	        height : "200",
	        width: "100%",
	        elements : ".post_content",
	        theme: "modern",
	        skin: "lightgray",
	        menubar : false,
	        statusbar : false,
	        toolbar: [ "bold italic forecolor blockquote link image media preview fullscreen "],
	        plugins : "link image fullscreen media preview autolink textcolor", // plugins folder in wp-includes/tinymce
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

</script>

<div align="right"><button class="editor-cancel">Cancel</button> <button class="submit">Submit</button></div>
<textarea id="<?php echo $editor_id; ?>" name='post_content'></textarea>

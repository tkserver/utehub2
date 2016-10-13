task = "";

function tinyNewPost() {
		tinymce.init( {
			mode : "exact",
			height : 300,
			elements : 'post_content',
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
}

function tinyNewPostReply(topic_id) {
		tinymce.init( {
			mode : "exact",
			height : 200,
			elements : "post_content_" + topic_id,
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
}



function myFunction() {
	alert("Feature not implemented yet! GO UTES!");
}
function lognToReply() {
	alert("Please login (or register) to post a message. GO UTES!");
}

function cancelPost(){
	jQuery(".reply-dialog").animate({height:0},700);
	//jQuery('#post_content, #bbp_topic_title, #bbp_forum_id').val("");
	jQuery(".cancelPost").text('Reply').removeClass("cancelPost btn-warning").addClass("replyPost");
    //jQuery("#threaded-new-message-cancel").text('Reply').removeClass("cancelPost btn-warning").addClass("replyPost").attr("id","threaded-new-message");;
	//tinyMCE.editors.length = 0;
	tinymce.remove();
	//alert('Number of editors: ' + tinyMCE.editors.length);
}

function cancelNewPost(){
	jQuery("#dialog").animate({height:0},700);
    jQuery("#threaded-new-message-cancel").text('New Message').removeClass("cancelNewPost btn-warning").addClass("btn-success").attr("id","threaded-new-message");;
	tinymce.remove();
	//alert('Number of editors: ' + tinyMCE.editors.length);

}

jQuery(document).on('click', '.cancelPost', function() {
		cancelPost();
});

jQuery(document).on('click', '#threaded-new-message-cancel', function() {
		cancelNewPost();
});


// NEW TOPIC
jQuery(document).on('click', '#threaded-new-message', function() {
	jQuery("#dialog").animate({height:400}, 1000);
	jQuery("#postTask").val("newPost");
	jQuery("#bbp_topic_title").removeClass('hidden');
	jQuery("#bbp_forum_id").removeClass('hidden');
	jQuery(".hide_on_reply").removeClass('hidden');
	jQuery('#threaded-new-message').addClass('btn-warning').removeClass('btn-success').text('Cancel');
	jQuery("#threaded-new-message").attr("id","threaded-new-message-cancel");
	tinyNewPost();
	task = undefined;
});

// REPLY TOPIC
jQuery(document).ready(function() {
	jQuery(document).on('click', '.replyPost', function(){
		alert(topic_id);
		jQuery("#dialog").height(0);
		jQuery(this).text('Cancel').addClass("btn-warning cancelPost").removeClass("replyPost");
		var editor_id = "#reply-dialog-" + topic_id;
		jQuery('html,body').animate({
			scrollTop: jQuery(editor_id).offset().top - 30
		});
		jQuery(editor_id).animate({height:300}, 1000);
		jQuery("#postTask").val("replyPost");
		jQuery("#topic_id").val(topic_id);
		jQuery("#forum_id").val(forum_id);
		jQuery("#bbp_topic_title").addClass('hidden');
		jQuery("#bbp_forum_id").addClass('hidden');
		jQuery(".hide_on_reply").addClass('hidden');
		jQuery('.cancelPost').not(this).addClass('replyPost').removeClass('cancelPost btn-warning').text('Reply');
		tinyNewPostReply(topic_id);
		task = undefined;
	})

});

// REPLY REPLY
jQuery(document).on('click', '.replyReply', function(){
	alert('reply id ' + reply_to);
		jQuery("#dialog").height(0);
		jQuery(this).text('Cancel').addClass("btn-warning cancelPost").removeClass("replyReply");
		//cool way to animate auto height!
		var editor_id = "#reply-dialog-" + reply_to;
		jQuery('html,body').animate({
			scrollTop: jQuery(editor_id).offset().top - 30
		});
		// var el = jQuery(editor_id),
		// curReplyHeight = el.height(),
		// autoReplyHeight = el.css('height', 'auto').height();
		// el.height(curReplyHeight).animate({height: autoReplyHeight}, 1000);
		//jQuery("#dialog").show().insertAfter(jQuery(replyPost_id).parent());
		jQuery(editor_id).animate({height:300}, 1000);
		jQuery("#postTask").val("replyReply");
		jQuery("#topic_id").val(topic_id);
		jQuery("#forum_id").val(forum_id);
		jQuery("#bbp_topic_title").addClass('hidden');
		jQuery("#bbp_forum_id").addClass('hidden');
		jQuery(".hide_on_reply").addClass('hidden');
		//jQuery("#h1_new_message").text("Post Reply");
		jQuery('.cancelPost').not(this).addClass('replyReply').removeClass('cancelPost btn-warning').text('Reply');
		tinyNewPostReply(topic_id);
		task = undefined;
	})


	jQuery.fn.extend({
			toggleText:function(a,b){
				if(this.html()==a){this.html(b)}
				else{this.html(a)}
		}
	});

	jQuery(document).ready(function() {
		jQuery('.more_button').click(function(){
			if(jQuery(this).prevAll(".threadContent, .replyContent").hasClass("contentLess")) {
				jQuery(this).prevAll(".threadContent, .replyContent").removeClass("contentLess");
				jQuery(this).prevAll(".threadContent, .replyContent").addClass("contentMore");
				jQuery(this).addClass("active");
				jQuery(this).text("Less");
			} else {
				jQuery(this).prevAll(".threadContent, .replyContent").removeClass("contentMore");
				jQuery(this).prevAll(".threadContent, .replyContent").addClass("contentLess");
				jQuery(this).removeClass("active");
				jQuery(this).text("More");
			}
			return false;
		});

		jQuery('.expand-all').click(function(){
			if(jQuery(".threadContent, .replyContent").hasClass("contentLess")) {
				jQuery(".threadContent, .replyContent").removeClass("contentLess");
				jQuery(".threadContent, .replyContent").addClass("contentMore");
				jQuery(".more_button").addClass("active");
				jQuery(".more_button").text("Less");
				jQuery(this).addClass("active");
				jQuery(this).text("Shrink All");
			} else {
				jQuery(".threadContent, .replyContent").removeClass("contentMore");
				jQuery(".threadContent, .replyContent").addClass("contentLess");
				jQuery(".more_button").removeClass("active");
				jQuery(".more_button").text("More");
				jQuery(this).removeClass("active");
				jQuery(this).text("Expand All");
			}
			return false;
		});

		jQuery('#expand-replies').click(function(){
			if(jQuery(".replies").hasClass("show_reply")) {
					jQuery(".replies").removeClass("show_reply");
					jQuery(".replies").addClass("hide_reply");
					jQuery(".show-replies-button").text("Show Replies");
					jQuery(this).text("Show Replies");
			} else {
					jQuery(".replies").removeClass("hide_reply");
					jQuery(".replies").addClass("show_reply");
					jQuery(".show-replies-button").text("Hide Replies");
					jQuery(this).text("Hide Replies");
			}
			return false;
		});

		jQuery('.show-replies-button').click(function(){
			if(jQuery(this).parent().next(".replies").hasClass("show_reply")) {
					jQuery(this).parent().next(".replies").removeClass("show_reply");
					jQuery(this).parent().next(".replies").addClass("hide_reply");
					jQuery(this).text("Show Replies");
			} else {
					jQuery(this).parent().next(".replies").removeClass("hide_reply");
					jQuery(this).parent().next(".replies").addClass("show_reply");
					jQuery(this).text("Hide Replies");
			}
			return false;
		});
	});

	function openThread () {
		window.open("postlink","_self")
	}
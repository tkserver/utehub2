    <h1 id="h1_new_message" class="pull-left">Post New Message</h1>
    <form id="reply-post" name="new-post" method="post" action="">
          <label class="hide_on_reply" for="bbp_topic_title">New Message</label>
          <br />
          <input class="form-control" type="text" id="bbp_topic_title" size="50" name="post_title" maxlength="80" />
          <p class="hide_on_reply">
            <label for="bbp_forum_id">Forum</label>
            <br />
            <select name="bbp_forum_id" id="bbp_forum_id" tabindex="104">
            	<option value="" class="level-0">(No Forum)</option><option class="level-0" disabled="disabled" value="">Utah Utes Sports</option>
                <option class="level-1" value="30">&nbsp;&nbsp;&nbsp;Men's Basketball</option>
                <option class="level-1" value="102">&nbsp;&nbsp;&nbsp;Other Ute Sports</option>
                <option class="level-1" value="41">&nbsp;&nbsp;&nbsp;Pac-12</option>
                <option class="level-1" value="60">&nbsp;&nbsp;&nbsp;Football</option>
                <option class="level-0" value="1773">General Topics</option>
                <option class="level-1" value="2290">&nbsp;&nbsp;&nbsp;Misc</option>
                <option class="level-1" value="1777">&nbsp;&nbsp;&nbsp;Politics</option>
                <option class="level-0" value="104">Professional Sports</option>
                <option class="level-1" value="116">&nbsp;&nbsp;&nbsp;Golf</option>
                <option class="level-1" value="110">&nbsp;&nbsp;&nbsp;MLB</option>
                <option class="level-1" value="108">&nbsp;&nbsp;&nbsp;NBA</option>
                <option class="level-1" value="106">&nbsp;&nbsp;&nbsp;NFL</option>
                <option class="level-1" value="1771">&nbsp;&nbsp;&nbsp;NHL</option>
                <option class="level-1" value="112">&nbsp;&nbsp;&nbsp;Soccer</option>
                <option class="level-1" value="114">&nbsp;&nbsp;&nbsp;Tennis</option>
                <option class="level-0" value="771">Ute Hub Site</option>
                <option class="level-1" value="119">&nbsp;&nbsp;&nbsp;Comments and Suggestions</option>
                <option class="level-1" value="775">&nbsp;&nbsp;&nbsp;How To Use Ute Hub</option>
                <option class="level-0" value="121">byu/tds</option>
            </select>
          </p>
        <!-- forum select list) -->
        <textarea id="post_content" name="post_content" class="form-control" placeholder="GO UTES!"></textarea>

        <input type="hidden" name="topic_id" id="topic_id" value="">
        <input type="hidden" name="post_parent" id="post_parent" value="">
        <input type="hidden" name="bbp_reply_to" id="bbp_reply_to" value="">
        <input type="hidden" name="post_author" id="post_author" value="1">
        <input type="hidden" name="forum_id" id="forum_id" value="60">
        <input type="hidden" name="task" id="postTask" value="newPost">
        <div class="submit-header">
            <button type="submit" id="bbp_reply_submit" name="bbp_reply_submit" class="btn btn-sm btn-default btn-success pull-right">Submit</button>
            <button type="button" class="btn btn-default btn-warning btn-sm pull-right" onclick="cancelPost()">Cancel</button>
        </div>
      </form>
      <script>
      tinymce.init({
        selector: 'textarea',  // change this value according to your HTML
        auto_focus: 'element1'
      });
      </script>

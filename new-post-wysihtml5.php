<form>
  <div id="toolbar">
    <a class="editor-button" data-wysihtml5-command="bold" title="CTRL+B" id="editor-bold">Bold</a>
    <a class="editor-button" data-wysihtml5-command="italic" title="CTRL+I" id="editor-italic">Italic</a>
    <a class="editor-button" data-wysihtml5-command="createLink" id="editor-link">Link</a>
    <a class="editor-button" data-wysihtml5-command="insertImage" id="editor-image">Image</a>
    <!-- <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1">H1</a>
    <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2">H2</a> -->
    <!-- <a data-wysihtml5-command="insertUnorderedList">insertUnorderedList</a> | -->
    <!-- <a data-wysihtml5-command="insertOrderedList">insertOrderedList</a> | -->
    <!-- <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red">Red</a> | -->
    <!-- <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green">green</a> | -->
    <!-- <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue">blue</a> | -->
    <!-- <a data-wysihtml5-command="insertSpeech">speech</a> -->
    <a class="editor-button" data-wysihtml5-action="change_view" id="editor-html">HTML</a>

    <div data-wysihtml5-dialog="createLink" style="display: none;">
      <label>
        Link:
        <input class="form-control" data-wysihtml5-dialog-field="href" value="http://">
    </label>
      <a class="btn btn-default btn-warning" data-wysihtml5-dialog-action="cancel">Cancel</a>&nbsp;<a class="btn btn-default btn-success" data-wysihtml5-dialog-action="save">OK</a>
    </div>

    <div data-wysihtml5-dialog="insertImage" style="display: none;">
      <label>
        Image:
        <input  class="form-control" data-wysihtml5-dialog-field="src" value="http://">
      </label>
      <label>
        Align:
        <select class="form-control" data-wysihtml5-dialog-field="className">
          <option value="">default</option>
          <option value="wysiwyg-float-left">left</option>
          <option value="wysiwyg-float-right">right</option>
        </select>
      </label><br>
      <a class="btn btn-default btn-warning" data-wysihtml5-dialog-action="cancel">Cancel</a>&nbsp;<a class="btn btn-default btn-success" data-wysihtml5-dialog-action="save">OK</a>
    </div>

  </div>
    <textarea class="form-control" name="post_content" id="textarea" placeholder="GO UTES!"></textarea>

    <div class="bbp-submit-wrapper">
        <div class="pull-left">
            <input class="btn btn-default" type="reset" value="Clear">
        </div>
        <div class="pull-right">
            <button type="button" class="btn btn-default btn-warning" data-dismiss="modal">Cancel</button>
            <button type="submit" id="bbp_reply_submit" name="bbp_reply_submit" class="btn btn-default btn-success">Submit</button>
        </div>
    </div>
    <input type="hidden" name="topic_id" id="topic_id" value="">
    <input type="hidden" name="post_parent" id="post_parent" value="">
    <input type="hidden" name="bbp_reply_to" id="bbp_reply_to" value="">
    <input type="hidden" name="post_author" id="post_author" value="1">
    <input type="hidden" name="forum_id" id="forum_id" value="60">
    <input type="hidden" name="task" id="postTask" value="newPost">
</form>

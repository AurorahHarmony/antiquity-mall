<?php

$title = 'New Post';

require_once(__DIR__ . '/../../inc/templates/header.php');
include(__DIR__ . '/../../inc/templates/manage/start.php');
?>

<script src="/static/js/tinymce/tinymce.min.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
  theme: "silver",
  mode: "exact",
  elements: "content",
  menubar: false,
  branding: false,
  theme_advanced_toolbar_location: "top",
  theme_advanced_buttons1: "bold,italic,underline,strikethrough,separator," +
    "justifyleft,justifycenter,justifyright,justifyfull,formatselect," +
    "bullist,numlist,outdent,indent",
  theme_advanced_buttons2: "link,unlink,anchor,image,separator," +
    "undo,redo,cleanup,code,separator,sub,sup,charmap",
  theme_advanced_buttons3: "",
  height: "350px",
  width: "100%"
});
</script>
<div class="display-4 text-muted mb-1">Post Title</div>
<form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
  <input type="text" name="title" placeholder="Post Title" class="form-control mb-3">

  <textarea name="content" rows="15" cols="80"></textarea>
  <br />
  <input type="submit" name="save" class="btn btn-success px-4" value="Publish" />
</form>

<?php
include(__DIR__ . '/../../inc/templates/manage/end.php');
require_once(__DIR__ . '/../../inc/templates/footer.php')
?>
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

<?php $article_data->echo_formatted_general_error() ?>

<div id="displayTitle" class="display-4 mb-1 <?= empty($article_data->get_value('title')) ? ' text-muted' : '' ?>">
  <?= !empty($article_data->get_value('title')) ? $article_data->get_value('title') : 'Post Title' ?>
</div>
<form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
  <div class="mb-3">
    <input type="text" name="title" id="titleInput" placeholder="Post Title"
      class="form-control <?php $article_data->echo_valid_class('title', true) ?>"
      value="<?= $article_data->get_value('title') ?>">
    <?php $article_data->echo_formatted_errors('title') ?>
  </div>

  <label for="excerpt" class="text-muted">Excerpt</label>
  <textarea class="form-control mb-1" name="excerpt"
    style="height: 100px"><?= $article_data->get_value('excerpt') ?></textarea>
  <?php $article_data->echo_raw_error('excerpt') ?>

  <div class="mt-2 mb-1 d-inline-block w-100">
    <label for="content" class="text-muted">Content</label>
    <textarea name="content" rows="15" cols="80"><?= $article_data->get_value('content')  ?></textarea>
    <div class="mt-2">
      <?php $article_data->echo_raw_error('content') ?>
    </div>
  </div>
  <input type="hidden" name="post_id" value="<?= $article_data->get_value('post_id') ?>">

  <hr class="mt-0 mb-2" />

  <input type="submit" name="save" class="btn btn-success px-5" value="Publish" />
</form>

<script>
var displayTitle = document.getElementById('displayTitle');
var titleInput = document.getElementById('titleInput');

titleInput.addEventListener('input', function() {
  if (titleInput.value.length > 0) {
    displayTitle.innerText = titleInput.value;
    displayTitle.classList.remove('text-muted');
  } else {
    displayTitle.innerText = 'Post Title';
    displayTitle.classList.add('text-muted');
  }
})
</script>
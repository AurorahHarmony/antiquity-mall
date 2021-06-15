<?php
require_once(__DIR__ . '/../../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route();

//GET Handling
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
  require_once(__DIR__ . '/../../inc/services/PostService.php');

  $post_data = PostService::get_one(trim($_GET['id']));

  if ($post_data == false) {
    header('location: /404');
    exit;
  }
}

//POST Handling
else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id'])) {

  require_once(__DIR__ . '/../../inc/services/PostService.php');

  $deleted = PostService::delete(trim($_POST['post_id']));

  if ($deleted === true) {
    header('location: /manage/posts/');
    exit;
  }
}

// All other requests
else {
  http_response_code('404');
  header('location: /404');
}

$title = 'Edit Post';
require_once(__DIR__ . '/../../inc/templates/header.php');

include(__DIR__ . '/../../inc/templates/manage/start.php');
?>

<?php if (isset($deleted) && $deleted !== true) : ?>
<div class='alert alert-danger' role='alert'>
  <?php echo $deleted ?>
</div>
<?php endif; ?>

<div class='alert alert-danger text-center' role='alert'>
  <h1 class="text-danger text-uppercase">DELETE <?= $post_data['title'] ?>?</h1>
  <p>This action is <strong>irreversable</strong>, and will <strong>permanently <span class="text-uppercase">DELETE
        <?= $post_data['title'] ?></span></strong></p>
  <p class="text-muted">Post ID: <?= $post_data['id'] ?><br>Created at
    <?= date_format(new DateTime($post_data['publish_date']), "g:ia - j/m/Y") ?></p>
  <form action="" method="post">
    <a href="/manage/posts" class="btn btn-success me-2">No Thankyou</a>
    <input type="hidden" name="post_id" value="<?= $post_data['id'] ?>">
    <button type="submit" name="really_delete" value="true" class="btn btn-secondary btn-sm">Delete</button>
  </form>
</div>

<?php
include(__DIR__ . '/../../inc/templates/manage/end.php');
require_once(__DIR__ . '/../../inc/templates/footer.php')
?>
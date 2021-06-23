<?php

if (isset($_GET['id']) || isset($_POST['id'])) {
  require_once(__DIR__ . '/../inc/services/PostService.php');
  $post_data = PostService::get_one(trim($_GET['id']));

  if ($post_data == false) {
    header('location: /404');
    exit;
  }
} else {
  header('location: /404');
  exit;
}


$title = 'Article';
require_once('../inc/templates/header.php');


require_once(__DIR__ . '/../inc/classes/FormHandler.php');
$new_comment = new Form(['comment' => '']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_comment']) && isset($_POST['id'])) {

  $new_comment->set_value('comment', trim($_POST['new_comment']));

  require_once(__DIR__ . '/../inc/services/PermissionService.php');
  $user_can_comment = PermissionService::has_perm('COMMENT', (int) $_SESSION['id'], true);

  if ($user_can_comment === false) {
    $new_comment->general_error = 'You do not have permission to comment';
  }

  if (strlen($_POST['new_comment']) < 1) {
    $new_comment->add_error('comment', 'A Comment cannot be empty');
  }
  if (strlen($_POST['new_comment']) > 255) {
    $new_comment->add_error('comment', 'Comments must be under 255 characters');
  }


  if (!$new_comment->has_errors()) {

    $escaped_comment = strip_tags(stripslashes($new_comment->get_value('comment')));

    require_once(__DIR__ . '/../inc/services/Database.php');
    $db = new Database;
    $db->insert('comments', ['post_id' => $_POST['id'], 'user_id' => $_SESSION['id'],  'comment' => $escaped_comment]);
  }
}
?>

<div class="container py-5">
  <div class="py-5">
    <h1 class="text-capitalize"><?= $post_data['title'] ?></h1>
    <?= $post_data['content'] ?>
  </div>
  <h2>Comments:</h2>
  <?php
  if (!empty($_SESSION['id'])) :
    $new_comment->echo_formatted_general_error();
  ?>
  <form method="POST" class="mb-4">
    <div class="mb-2">
      <div class="form-floating">
        <textarea class="form-control <?php $new_comment->echo_valid_class('comment', true) ?>"
          placeholder="Add a comment here" name="new_comment" id="new_comment" style="height: 100px"></textarea>
        <label for="floatingTextarea">Add Comment</label>
        <?php $new_comment->echo_formatted_errors('comment') ?>
      </div>
    </div>
    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
    <button type="submit" class="btn btn-primary px-5">Add Comment</button>
  </form>
  <?php else : ?>
  <a href="/login?redirect=article&id=<?= $_GET['id'] ?>" class="btn btn-primary px-5 mb-4">Login to Comment</a>
  <?php endif; ?>

  <table class="table table-striped">
    <?php
    require_once(__DIR__ . '/../inc/services/Database.php');
    $db = new Database;
    $all_comments = $db->select('SELECT username, comment, created FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = :post_id ORDER BY comments.created DESC', ['post_id' => $_GET['id']]);

    if (count($all_comments) < 1) : ?>
    <p class="text-muted">There are no comments.</p>
    <?php
    else :
      foreach ($all_comments as $comment) :
      ?>
    <tr>
      <td class="px-3 py-4">
        <div class="row">
          <div class="col-sm">
            <p class="h6 mb-0"><?= $comment['username'] ?></p>
          </div>
          <div class="col-sm text-sm-end">
            <p class="h6 mb-0 text-muted"><?= date_format(new DateTime($comment['created']), "(g:ia) j M, Y") ?></p>
          </div>
        </div>
        <p class="mb-0"><?= strip_tags(stripslashes($comment['comment'])) ?></p>
      </td>
    </tr>

    <?php
      endforeach;
    endif;
    ?>
  </table>
</div>
<?php require_once('../inc/templates/footer.php') ?>
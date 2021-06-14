<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
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
?>

<div class="container py-5">
  <div class="py-5">
    <h1 class="text-capitalize"><?= $post_data['title'] ?></h1>
    <?= $post_data['content'] ?>
  </div>
</div>
<?php require_once('../inc/templates/footer.php') ?>
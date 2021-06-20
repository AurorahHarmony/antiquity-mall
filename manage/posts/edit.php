<?php
require_once(__DIR__ . '/../../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route('ACCESS_MANAGER', true);

require_once(__DIR__ . '/../../inc/services/PermissionService.php');
$can_edit = PermissionService::has_perm('MANAGE_POSTS', $_SESSION['id']);

if ($can_edit) :
  //GET Handling
  if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    require_once(__DIR__ . '/../../inc/services/PostService.php');

    $post_data = PostService::get_one(trim($_GET['id']));

    if ($post_data == false) {
      header('location: /404');
      exit;
    }

    require_once(__DIR__ . '/../../inc/classes/FormHandler.php');
    $article_values = [
      'title' => $post_data['title'],
      'content' => $post_data['content'],
      'post_id' => $post_data['id'],
      'excerpt' => $post_data['excerpt']
    ];
    $article_data = new Form($article_values);
  }

  //POST Handling
  else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id'])) {

    require_once(__DIR__ . '/../../inc/services/PostService.php');
    $article_values = [
      'title' => $_POST['title'] ?? '',
      'content' => $_POST['content'] ?? '',
      'excerpt' => $_POST['excerpt']
    ];
    $article_data = new Form($article_values);
    $updated = PostService::update($_POST['post_id'], $article_data);

    if ($updated === true) {
      header('location: /manage/posts/');
      exit;
    }
  }

  // All other requests
  else {
    http_response_code('404');
    header('location: /404');
  }

endif;

$title = 'Edit Post';
require_once(__DIR__ . '/../../inc/templates/manage/start.php');

if ($can_edit) :

  require_once(__DIR__ . '/../../inc/components/posts/editor.php');

else :
  PermissionService::echo_insufficient_perm();
endif;

require_once(__DIR__ . '/../../inc/templates/manage/end.php');
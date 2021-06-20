<?php
require_once(__DIR__ . '/../../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route('ACCESS_MANAGER', true);

require_once(__DIR__ . '/../../inc/services/PermissionService.php');
$can_edit = PermissionService::has_perm('MANAGE_POSTS', $_SESSION['id']);

if ($can_edit) :
  require_once(__DIR__ . '/../../inc/classes/FormHandler.php');
  $article_values = [
    'title' => $_POST['title'] ?? '',
    'user_id' => $_SESSION['id'],
    'excerpt' => $_POST['excerpt'],
    'content' => $_POST['content'] ?? ''
  ];
  $article_data = new Form($article_values);

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once(__DIR__ . '/../../inc/services/PostService.php');
    $created = PostService::create($article_data);

    if ($created === true) {
      header('location: /manage/posts/');
    }
  }
endif;

$title = 'New Post';
require_once(__DIR__ . '/../../inc/templates/manage/start.php');

if ($can_edit) :

  require_once(__DIR__ . '/../../inc/components/posts/editor.php');

else :
  PermissionService::echo_insufficient_perm();
endif;

require_once(__DIR__ . '/../../inc/templates/manage/end.php');
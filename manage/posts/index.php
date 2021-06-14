<?php
require_once(__DIR__ . '/../../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route();

require_once(__DIR__ . '/../../inc/services/PostService.php');
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//   require_once(__DIR__ . '/../../inc/services/PostService.php');
//   $created = PostService::create($article_data);

//   if ($created === true) {
//     header('location: /manage/posts/');
//   }
// }

$title = 'All Posts';
require_once(__DIR__ . '/../../inc/templates/header.php');

include(__DIR__ . '/../../inc/templates/manage/start.php');

$all_posts = PostService::get_all(); ?>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col" class="text-end">Created On</th>
      <th scope="col" class="text-end">Actions</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($all_posts as $post) : ?>

    <tr>
      <th scope="row"><?= $post['id'] ?></th>
      <td><?= $post['title'] ?></td>
      <td class="text-muted text-end"><?= date_format(new DateTime($post['publish_date']), "j M, Y \a\\t g:ia ")  ?>
      </td>
      <td class="text-end">
        <a href="/news/article?id=<?= $post['id'] ?>" class="mx-1" title="View"><i
            class="bi bi-eye text-success"></i></a>
        <a href="/manage/posts/edit?id=<?= $post['id'] ?>" class="mx-1" title="Edit"><i
            class="bi bi-pencil-square text-info"></i></a>
        <a href="/manage/posts/delete?id=<?= $post['id'] ?>" class="mx-1" title="Delete"><i
            class="bi bi-trash text-danger"></i></a>
      </td>
    </tr>

    <?php endforeach; ?>

  </tbody>
</table>
<?php
include(__DIR__ . '/../../inc/templates/manage/end.php');
require_once(__DIR__ . '/../../inc/templates/footer.php')
?>
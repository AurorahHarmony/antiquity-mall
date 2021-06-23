<?php
require_once(__DIR__ . '/../../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route('ACCESS_MANAGER', true);

$title = 'All Posts';
require_once(__DIR__ . '/../../inc/templates/manage/start.php');

require_once(__DIR__ . '/../../inc/services/PostService.php');
$all_posts = PostService::get_all(); ?>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col" class="text-end">Created</th>
      <th scope="col" class="text-end">Actions</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($all_posts as $post) : ?>

    <tr>
      <th scope="row"><?= $post['id'] ?></th>
      <td><?= $post['title'] ?></td>
      <td class="text-muted text-end"><?= date_format(new DateTime($post['publish_date']), "g:ia - j/m/Y")  ?>
      </td>
      <td class="text-end">
        <a href="/news/article?id=<?= $post['id'] ?>" class="mx-1 mb-3 mb-sm-0 d-block d-sm-inline" title="View"><i
            class="bi bi-eye text-success"></i></a>
        <a href="/manage/posts/edit?id=<?= $post['id'] ?>" class="mx-1 mb-3 mb-sm-0 d-block d-sm-inline" title="Edit"><i
            class="bi bi-pencil-square text-info"></i></a>
        <a href="/manage/posts/delete?id=<?= $post['id'] ?>" class="mx-1 d-block d-sm-inline" title="Delete"><i
            class="bi bi-trash text-danger"></i></a>
      </td>
    </tr>

    <?php endforeach; ?>

  </tbody>
</table>
<?php
require_once(__DIR__ . '/../../inc/templates/manage/end.php');
?>
<?php
require_once(__DIR__ . '/../../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route('ACCESS_MANAGER', true);

$title = 'All Users';
require_once(__DIR__ . '/../../inc/templates/manage/start.php');

require_once(__DIR__ . '/../../inc/services/UserService.php');
$all_users = UserService::get_all();
?>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Username</th>
      <th scope="col">Role</th>
      <th scope="col" class="text-end">Actions</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($all_users as $user) : ?>

    <tr>
      <th scope="row"><?= $user['id'] ?></th>
      <td><?= $user['username'] ?></td>
      <td><?= $user['role_name'] ?></td>
      <td class="text-end">
        <a href="/manage/users/edit-user?id=<?= $user['id'] ?>" class="mx-1" title="Edit"><i
            class="bi bi-pencil-square text-info"></i></a>
      </td>
    </tr>

    <?php endforeach; ?>

  </tbody>
</table>

<?php require_once(__DIR__ . '/../../inc/templates/manage/end.php'); ?>
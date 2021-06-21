<?php
require_once(__DIR__ . '/../../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route('ACCESS_MANAGER', true);

require_once(__DIR__ . '/../../inc/services/PermissionService.php');
$can_edit = PermissionService::has_perm('MANAGE_USERS', $_SESSION['id']);

if ($can_edit) :
  require_once(__DIR__ . '/../../inc/classes/FormHandler.php');
  $user_settings = new Form();

  if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {

    require_once(__DIR__ . '/../../inc/services/UserService.php');
    $the_user = UserService::get_one((int) $_GET['id']);
    if ($the_user === false) {
      header('location: /404');
      exit;
    }
  } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {

    $user_settings->set_value('role_id', (int) $_POST['user_role']);

    require_once(__DIR__ . '/../../inc/services/UserService.php');
    $updated = UserService::admin_update($_POST['user_id'], $user_settings);

    if ($updated === true) {
      header('location: /manage/users/');
      exit;
    }

    require_once(__DIR__ . '/../../inc/services/UserService.php');
    $the_user = UserService::get_one((int) $_GET['id']);
  } else {
    header('location: /404');
    exit;
  }
endif;

$title = 'Edit User';
require_once(__DIR__ . '/../../inc/templates/manage/start.php');


if ($can_edit) :
  $user_settings->echo_formatted_general_error()
?>


<h2>Viewing: <?= $the_user['username'] ?> <span class="text-muted">(id: <?= $the_user['id'] ?>)</span></h2>

<?php
  require_once(__DIR__ . '/../../inc/services/PermissionService.php');
  $avail_roles = PermissionService::get_available_roles();
  ?>
<form method="POST">
  <label for="user_role" class="form-label">User's Role</label>
  <select name="user_role" class="form-select mb-3">
    <?php foreach ($avail_roles as $role) : ?>
    <option value="<?= $role['role_id'] ?>" <?php if ($the_user['role_id'] == $role['role_id']) echo 'selected' ?>>
      <?= $role['role_name'] ?></option>
    <?php endforeach; ?>

  </select>

  <input type="hidden" name="user_id" value="<?= $the_user['id'] ?>">
  <button type="submit" class="btn btn-info px-5">Save User</button>
</form>

<?php
else :
  PermissionService::echo_insufficient_perm();
endif;

require_once(__DIR__ . '/../../inc/templates/manage/end.php'); ?>
<?php
require_once(__DIR__ . '/../../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route('ACCESS_MANAGER', true);

$title = 'Edit Roles';
require_once(__DIR__ . '/../../inc/templates/manage/start.php');


require_once(__DIR__ . '/../../inc/services/PermissionService.php');
$avail_roles = PermissionService::get_available_roles();
?>
<select name="user_role" id="roleSelector" class="form-select mb-3">
  <option value="" disabled <?= !isset($_GET['id']) ? 'selected' : '' ?>>Please select a Role to modify</option>
  <?php foreach ($avail_roles as $role) : ?>
  <option value="<?= $role['role_id'] ?>"
    <?= (isset($_GET['id']) && $_GET['id'] == $role['role_id']) ? 'selected' : '' ?>>
    <?= $role['role_name'] ?></option>
  <?php endforeach; ?>
</select>

<?php
if (isset($_GET['id'])) :
  $role_perms = PermissionService::get_role_perm_array($_GET['id']);
  $all_perms = PermissionService::get_all_permissions();
?>

<form method="POST">
  <?php foreach ($all_perms as $avail_perm) : ?>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="<?= $avail_perm['perm_name'] ?>"
      name="<?= $avail_perm['perm_name'] ?>"
      <?= (array_search($avail_perm['perm_id'], $role_perms) !== false) ? 'checked' : '' ?>>
    <label class="form-check-label" for="<?= $avail_perm['perm_name'] ?>">
      <?= $avail_perm['perm_name'] ?>
    </label>
  </div>
  <?php endforeach; ?>
</form>
<?php endif; ?>
<script>
var roleSelector = document.getElementById('roleSelector');

roleSelector.addEventListener('change', () => {
  window.location = '/manage/users/edit-roles?id=' + roleSelector.value;
})
</script>

<?php require_once(__DIR__ . '/../../inc/templates/manage/end.php'); ?>
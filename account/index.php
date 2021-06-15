<?php
require_once('../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route();

$title = 'My Account';

require_once(__DIR__ . '/../inc/templates/header.php');
include(__DIR__ . '/../inc/templates/account/start.php');
?>

<p>Welcome, <b><?php echo $_SESSION['username'] ?? 'username' ?></b>.</p>


<?php
require_once(__DIR__ . '/../inc/services/PermissionService.php');

$user_role = PermissionService::get_role($_SESSION['id']);
$user_perms = implode(", ", PermissionService::get_perms($_SESSION['id']));
?>
<p>Your Role is <?= $user_role ?></p>
<p>Your Permissions are <?= $user_perms ?></p>

<?php
include(__DIR__ . '/../inc/templates/account/end.php');
require_once(__DIR__ . '/../inc/templates/footer.php')
?>
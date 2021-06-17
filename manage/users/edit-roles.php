<?php
require_once(__DIR__ . '/../../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route('ACCESS_MANAGER', true);

$title = 'Edit Roles';
require_once(__DIR__ . '/../../inc/templates/manage/start.php');
?>

<p>Edit Roles</p>

<?php require_once(__DIR__ . '/../../inc/templates/manage/end.php'); ?>
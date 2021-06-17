<?php
require_once(__DIR__ . '/../../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route('ACCESS_MANAGER', true);

$title = 'Site Dashboard';
require_once(__DIR__ . '/../../inc/templates/manage/start.php');
?>

<p>All Users</p>

<?php require_once(__DIR__ . '/../../inc/templates/manage/end.php'); ?>
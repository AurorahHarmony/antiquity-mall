<?php
require_once(__DIR__ . '/../../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route('ACCESS_MANAGER', true);

$title = 'Upload Version';
require_once(__DIR__ . '/../../inc/templates/manage/start.php');
?>

<p>Upload</p>

<?php require_once(__DIR__ . '/../../inc/templates/manage/end.php'); ?>
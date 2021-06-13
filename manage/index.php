<?php
require_once('../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route();

$title = 'My Account';

require_once(__DIR__ . '/../inc/templates/header.php');
include(__DIR__ . '/../inc/templates/manage/start.php');
?>

<p>This is the admin dashboard!</p>

<?php
include(__DIR__ . '/../inc/templates/manage/end.php');
require_once(__DIR__ . '/../inc/templates/footer.php')
?>
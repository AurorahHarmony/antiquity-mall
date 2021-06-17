<?php
require_once('../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route();

$title = 'My Downloads';

require_once(__DIR__ . '/../inc/templates/header.php');

$tab_name = 'downloads';
include(__DIR__ . '/../inc/templates/account/start.php');
?>

<p>Welcome to the downloads page</p>

<?php
include(__DIR__ . '/../inc/templates/account/end.php');
require_once(__DIR__ . '/../inc/templates/footer.php')
?>
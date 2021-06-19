<?php
require_once('../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route();

$title = 'My Downloads';

require_once(__DIR__ . '/../inc/templates/header.php');

$tab_name = 'downloads';
include(__DIR__ . '/../inc/templates/account/start.php');

require_once(__DIR__ . '/../inc/services/Database.php');
$db = new Database;

$windows_version = $db->select('SELECT * FROM active_versions JOIN game_versions ON active_versions.version_id = game_versions.id JOIN uploads ON game_versions.upload_id = uploads.id WHERE active_versions.platform_name = "windows"');
$windows_version = $windows_version[0] ?? null;
$mac_version = $db->select('SELECT * FROM active_versions JOIN game_versions ON active_versions.version_id = game_versions.id JOIN uploads ON game_versions.upload_id = uploads.id WHERE active_versions.platform_name = "mac"');
$mac_version = $mac_version[0] ?? null;
?>

<h2>All Versions</h2>
<div class="row">
  <?php if (!empty($windows_version)) : ?>
  <div class="col-md-6">
    Windows Download
    <a href="/uploads/<?= $windows_version['file_name'] ?>">Version <?= $windows_version['version_number'] ?></a>
    <p class="text-muted">Created On <?= date_format(new DateTime($windows_version['created']), "g:ia - j/m/Y") ?></p>
  </div>
  <?php
  endif;
  if (!empty($mac_version)) :
  ?>
  <div class="col-md-6">
    Mac Download
    <a href="/uploads/<?= $mac_version['file_name'] ?>">Version <?= $mac_version['version_number'] ?></a>
    <p class="text-muted">Created On <?= date_format(new DateTime($mac_version['created']), "g:ia - j/m/Y") ?></p>
  </div>
  <?php endif; ?>
</div>

<?php
include(__DIR__ . '/../inc/templates/account/end.php');
require_once(__DIR__ . '/../inc/templates/footer.php')
?>
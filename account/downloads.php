<?php
require_once('../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route(null, null, '?redirect=downloads');

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

<h2 class="mb-5 text-center">All Versions</h2>
<div class="row">
  <?php if (!empty($windows_version)) : ?>
  <div class="col-md-6 text-center">
    <a href="/uploads/<?= $windows_version['file_name'] ?>">
      <img src="/static/img/windows_logo.svg" style="height: 135px" class="mb-3" alt="Windows Logo">
    </a>
    <p class="mb-1">
      Windows Download
      <a href="/uploads/<?= $windows_version['file_name'] ?>">Version <?= $windows_version['version_number'] ?></a>
    </p>
    <p class="text-muted">Created On <?= date_format(new DateTime($windows_version['created']), "g:ia - j/m/Y") ?></p>
  </div>
  <?php
  endif;
  if (!empty($mac_version)) :
  ?>
  <div class="col-md-6 text-center">
    <a href="/uploads/<?= $mac_version['file_name'] ?>">
      <img src="/static/img/apple_logo.svg" style="height: 135px" class="mb-3" alt="Apple Logo">
    </a>
    <p class="mb-1">
      Mac Download
      <a href="/uploads/<?= $mac_version['file_name'] ?>">Version <?= $mac_version['version_number'] ?></a>
    </p>
    <p class="text-muted">Created On <?= date_format(new DateTime($mac_version['created']), "g:ia - j/m/Y") ?></p>
  </div>
  <?php endif; ?>
</div>

<?php
include(__DIR__ . '/../inc/templates/account/end.php');
require_once(__DIR__ . '/../inc/templates/footer.php')
?>
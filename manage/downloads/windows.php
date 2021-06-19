<?php
require_once(__DIR__ . '/../../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route('ACCESS_MANAGER', true);

$title = 'Windows Version';
require_once(__DIR__ . '/../../inc/templates/manage/start.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['active_version'])) {
    require_once(__DIR__ . '/../../inc/services/Database.php');
    $db = new Database;
    $db->beginTransaction();
    $db->delete('active_versions', 'platform_name = "windows"');
    if ($_POST['active_version'] != 'none') {
      $db->insert('active_versions', ['platform_name' => 'windows', 'version_id' => $_POST['active_version']]);
    }
    $db->commit();
  } else {
    require_once(__DIR__ . '/../../inc/services/Database.php');
    $db = new Database;
    $latest_version = $db->select('SELECT * FROM game_versions WHERE platform_name = "windows" ORDER BY version_number DESC LIMIT 1');
    $latest_version_num = $latest_version[0]['version_number'] ?? 0;
    $latest_version_num++;

    $upload_dir = __DIR__ . '/../../uploads/';
    $new_filename = "versions/dreamscape_windows-v$latest_version_num.zip";
    $target_file = $upload_dir . $new_filename;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($_FILES["file_upload"]["name"], PATHINFO_EXTENSION));

    if (
      $fileType != "zip"
    ) {
      echo "Sorry, only .zip files are allowed.";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    } else {
      $db = new Database;
      $db->beginTransaction();
      $uploaded_details = $db->insert('uploads', ['file_name' => $new_filename, 'uploader_id' => $_SESSION['id']]);
      $db->insert('game_versions', ['platform_name' => 'windows', 'version_number' => $latest_version_num, 'upload_id' => $uploaded_details['id']]);
      $db->commit();
      if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["file_upload"]["name"])) . " has been uploaded successfully!";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }
}
?>

<form method="post" class="mb-3" enctype="multipart/form-data">
  <div class="mb-1">
    <div class="row">
      <label for="file_upload" class="form-label mb-0">Upload New Version</label>
      <div class="col">
        <input class="form-control" type="file" name="file_upload" id="file_upload">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary px-5" name="submit" value="true">Upload</button>
      </div>
    </div>
  </div>
</form>

<?php
require_once(__DIR__ . '/../../inc/services/Database.php');
$db = new Database;
$all_uploaded = $db->select('SELECT game_versions.id, version_number, file_name  FROM game_versions JOIN uploads ON game_versions.upload_id = uploads.id WHERE platform_name = "windows" ORDER BY version_number DESC');

$active_version = $db->select('SELECT version_id FROM active_versions WHERE platform_name = "windows"');
$active_version = $active_version[0] ?? null;
?>

<form method="post" class="mb-3">
  <div class="mb-1">
    <div class="row">
      <label for="active_version" class="form-label mb-0">Set Current Version (Version shown to Users)</label>
      <div class="col">
        <!-- <input class="form-control" type="file" name="file_upload" id="file_upload"> -->
        <select name="active_version" id="active_version" class="form-select">
          <option value="none">None</option>
          <?php foreach ($all_uploaded as $upload) : ?>
          <option value="<?= $upload['id'] ?>"
            <?= (!empty($active_version['version_id']) && $active_version['version_id'] == $upload['id']) ? 'selected' : '' ?>>
            Version:
            <?= $upload['version_number'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary px-5" name="submit" value="true">Apply</button>
      </div>
    </div>
  </div>
</form>

<p class="h2">All Windows Versions</p>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Version</th>
      <th scope="col">File Name</th>
      <th scope="col" class="text-end">Actions</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($all_uploaded as $upload) : ?>

    <tr>
      <th scope="row"><?= $upload['version_number'] ?></th>

      <td><?= $upload['file_name'] ?></td>
      <td class="text-end">
        <a href="<?= '/uploads/' . $upload['file_name'] ?>" class="mx-1" title="Download"><i
            class="bi bi-download text-info"></i></a>
        <!-- <a href="#" class="mx-1" title="Edit"><i class="bi bi-pencil-square text-info"></i></a> -->
      </td>
    </tr>

    <?php endforeach; ?>

  </tbody>
</table>


<?php require_once(__DIR__ . '/../../inc/templates/manage/end.php'); ?>
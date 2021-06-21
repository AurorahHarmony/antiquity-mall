<?php
require_once('../inc/handlers/SessionHandler.php');
$session = new Session;
$session->protected_route();

$title = 'My Profile';

require_once(__DIR__ . '/../inc/templates/header.php');

$tab_name = 'profile';
include(__DIR__ . '/../inc/templates/account/start.php');

//Init the Form
require_once(__DIR__ . '/../inc/classes/FormHandler.php');
$form_fields =  [
  'email' => '',
  'new_password' => '',
  'confirm_new_password' => '',
  'current_password' => ''
];
$form = new Form($form_fields);

//Get Current profile information
require_once(__DIR__ . '/../inc/services/UserService.php');
$current_profile = UserService::get_one($_SESSION['id']);

//Set form fields based on current information
$form->set_value('email', $current_profile['email']);

$updated = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $form->set_value('email', trim($_POST['email']));
  $form->set_value('new_password', $_POST['new_password']);
  $form->set_value('confirm_new_password', $_POST['confirm_new_password']);
  $form->set_value('current_password', $_POST['current_password']);

  $updated = UserService::update($_SESSION['id'], $form);
}

?>

<h2>My Profile</h2>

<?php $form->echo_formatted_general_error();

if ($updated) :
?>

<div class='alert alert-success' role='alert'>Update Successful</div>

<?php endif; ?>

<form method="POST">
  <div class="mb-3">
    <label for="email" class="form-label"><b>Email address</b></label>
    <input type="text" class="form-control <? $form->echo_valid_class('email', true) ?>" id="email" name="email"
      value="<?= $form->get_value('email') ?>">
    <?php $form->echo_formatted_errors('email') ?>
  </div>
  <hr>
  <div class="mb-3">
    <label for="new_password" class="form-label">
      <b>Change Password</b>
    </label>
    <div class="row">
      <div class="col-md">
        <input type="password" class="form-control mb-3 <? $form->echo_valid_class('new_password', true) ?>"
          id="new_password" name="new_password" placeholder="New Password">
        <?php $form->echo_formatted_errors('new_password') ?>
      </div>
      <div class="col-md">
        <input type="password" class="form-control <? $form->echo_valid_class('confirm_new_password', true) ?>"
          id="confirm_new_password" name="confirm_new_password" placeholder="Confirm New Password">
        <?php $form->echo_formatted_errors('confirm_new_password') ?>
      </div>
    </div>

  </div>


  <hr>

  <div class="mb-3">
    <label for="current_password" class="form-label"><b>Current Password</b></label>
    <input type="password" class="form-control <? $form->echo_valid_class('current_password', true) ?>"
      id="current_password" name="current_password" placeholder="Password">
    <?php $form->echo_formatted_errors('current_password') ?>
  </div>

  <div class="text-end">
    <button type="submit" class="btn btn-primary px-5 text-end">Update</button>
  </div>

</form>

<?php
include(__DIR__ . '/../inc/templates/account/end.php');
require_once(__DIR__ . '/../inc/templates/footer.php')
?>
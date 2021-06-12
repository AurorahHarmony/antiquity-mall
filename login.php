<?php
// Create the Form instance
require_once('inc/classes/FormHandler.php');
$values = [
  'username' => $_POST['username'],
  'password' => $_POST['password']
];
$form = new Form($values);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  require_once('inc/services/UserService.php');
  $validated = UserService::validate($form);

  if ($validated === true) {
    header('location: /account');
    exit;
  }
}

$title = 'Login';

require_once('inc/templates/header.php');

?>
<div class="container-fluid gradient-pinkorange">
  <div class="row">
    <div class="col-sm-2 col-md-6">
    </div>
    <div class="col-sm-10 col-md-6 p-5 bg-white">
      <div class="col-lg-8">

        <h1>Login</h1>
        <p>Sign in to your account</p>
        <?php $form->echo_formatted_general_error() ?>
        <form class="small" method="POST">
          <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control" id="username" placeholder="Username">
            <label for="username">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            <label for="password">Password</label>
          </div>
          <button type="submit" class="btn btn-primary w-100">Sign In</button>
          <hr>
          <div class="text-center">
            <a href="/register">Register</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<?php require_once('inc/templates/footer.php') ?>
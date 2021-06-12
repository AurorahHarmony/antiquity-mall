<?php
// Create the Form instance
require_once('inc/classes/FormHandler.php');
$values = [
  'username' => $_POST['username'],
  'email' => $_POST['email'],
  'dob' => $_POST['dob'],
  'password' => $_POST['password'],
  'confirm_password' => $_POST['confirmPassword'],
  'privacy_policy' => $_POST['privacyPolicy'],
  'eula' => $_POST['eula'],
];
$form = new Form($values);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  require_once('inc/services/UserService.php');
  $created = UserService::create($form);

  if ($created === true) {
    header('location: /registration-success?username=' . $form->get_value('username'));
    exit;
  }
}

$title = 'Register';

require_once('inc/templates/header.php');

?>
<div class="container-fluid gradient-pinkorange">
  <div class="row">
    <div class="col-sm-2 col-md-6">
    </div>
    <div class="col-sm-10 col-md-6 p-5 bg-white">
      <div class="col-lg-8">

        <h1>Register</h1>
        <p>Create a new account</p>
        <?php $form->echo_formatted_general_error() ?>
        <form class="small" method="POST">
          <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control <?php $form->echo_valid_class('username') ?>" id="username" placeholder="username" value="<?php echo $form->get_value('username') ?>">
            <label for="username">Username</label>
            <?php $form->echo_formatted_errors('username') ?>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="email" class="form-control <?php $form->echo_valid_class('email') ?>" id="email" placeholder="name@example.com" value="<?php echo $form->get_value('email') ?>">
            <label for="email">Email address</label>
            <?php $form->echo_formatted_errors('email') ?>
          </div>
          <div class="form-floating mb-3">
            <input type="date" name="dob" class="form-control <?php $form->echo_valid_class('dob') ?>" id="dob" value="<?php echo $form->get_value('dob') ?>">
            <label for="dob">Date of Birth</label>
            <?php $form->echo_formatted_errors('dob') ?>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control <?php $form->echo_valid_class('password', true) ?>" id="password" placeholder="Password">
            <label for="password">Password</label>
            <?php $form->echo_formatted_errors('password') ?>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="confirmPassword" class="form-control <?php $form->echo_valid_class('confirm_password', true) ?>" id="confirmPassword" placeholder="Password">
            <label for="confirmPassword">Confirm Password</label>
            <?php $form->echo_formatted_errors('confirm_password') ?>
          </div>
          <div class="form-check mb-1">
            <input class="form-check-input <?php $form->echo_valid_class('privacy_policy', true) ?>" name="privacyPolicy" type="checkbox" id="privacyPolicy">
            <label class="form-check-label" for="privacyPolicy">
              I agree to the <a href="/privacy-policy" target="register-rules">Privacy Policy</a>
            </label>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input <?php $form->echo_valid_class('eula', true) ?>" name="eula" type="checkbox" id="eula">
            <label class="form-check-label" for="eula">
              I agree to the <a href="/eula" target="register-rules">EULA</a>
            </label>
          </div>
          <div class="mb-3">
            <?php
            $form->echo_raw_error('privacy_policy');
            $form->echo_raw_error('eula');
            ?>
          </div>

          <button type="submit" class="btn btn-primary w-100">Register</button>
          <hr>
          <div class="text-center">
            <a href="/login">Login</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- <div class="container py-5">
  <div class="py-5">
    <h1>Login</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore maiores iusto nihil doloremque autem quia dicta
      velit eius, asperiores facere iste minus cumque tenetur quo suscipit ex, eos similique modi.</p>
  </div>
</div> -->
<?php require_once('inc/templates/footer.php') ?>
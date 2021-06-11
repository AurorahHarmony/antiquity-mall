<?php
$title = 'Login';

require_once('inc/templates/header.php');

require_once('inc/services/UserService.php');

// $newUser = UserService::create()

?>
<div class="container-fluid gradient-pinkorange">
  <div class="row">
    <div class="col-sm-2 col-md-6">
    </div>
    <div class="col-sm-10 col-md-6 p-5 bg-white">
      <div class="col-lg-8">

        <h1>Register</h1>
        <p>Create a new account</p>
        <form class="small">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" placeholder="name@example.com">
            <label for="username">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" placeholder="name@example.com">
            <label for="email">Email address</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" class="form-control" id="dob" placeholder="name@example.com">
            <label for="dob">Date of Birth</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" placeholder="Password">
            <label for="password">Password</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="confirmPassword" placeholder="Password">
            <label for="confirmPassword">Confirm Password</label>
          </div>
          <div class="form-check mb-1">
            <input class="form-check-input" type="checkbox" id="privacyPolicy">
            <label class="form-check-label" for="privacyPolicy">
              I agree to the <a href="/privacy-policy" target="_blank">Privacy Policy</a>
            </label>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="eula">
            <label class="form-check-label" for="eula">
              I agree to the <a href="/eula" target="_blank">EULA</a>
            </label>
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
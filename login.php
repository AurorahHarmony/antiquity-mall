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

        <h1>Login</h1>
        <p>Sign in to your account</p>
        <form class="small">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
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

<!-- <div class="container py-5">
  <div class="py-5">
    <h1>Login</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore maiores iusto nihil doloremque autem quia dicta
      velit eius, asperiores facere iste minus cumque tenetur quo suscipit ex, eos similique modi.</p>
  </div>
</div> -->
<?php require_once('inc/templates/footer.php') ?>
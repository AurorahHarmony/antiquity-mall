<?php

$title = 'Registration Successful';

require_once('inc/templates/header.php');

?>
<div class="container-fluid gradient-pinkorange">
  <div class="row">
    <div class="col-sm-2 col-md-6">
    </div>
    <div class="col-sm-10 col-md-6 p-5 bg-white">
      <div class="col-lg-8">

        <h1>Registration Successful</h1>
        <p>Welcome to the Dreamscape<?php echo !empty($_GET['username']) ? ', <b>' . $_GET['username'] . '</b>' : '' ?>!
        </p>
        <div class='alert alert-info' role='alert'>Head to the <a href="/login">Login Page</a> once you've activated
          your account. Then you can download the game from the "My Downloads" tab.</div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require_once('inc/templates/footer.php') ?>
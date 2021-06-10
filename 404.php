<?php
$title = 'Page Not Found';
http_response_code(404);

require_once('inc/templates/header.php') ?>

<div class="container py-5">
  <div class="py-5">
    <h1>Page Not Found 🐇</h1>
    <p>That's no good... <a href="/">Go back home</a> where it's safe and sound!</p>
  </div>
</div>
<?php require_once('inc/templates/footer.php') ?>
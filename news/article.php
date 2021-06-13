<?php
$title = 'Article';

require_once('../inc/templates/header.php')
?>

<div class="container py-5">
  <div class="py-5">
    <h1>Article</h1>
    <p>Welcome to article <?php echo $_GET['id'] ?></p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, totam eaque. Tempora, aliquam eius. Rem quia,
      eveniet commodi aspernatur tempore quaerat suscipit velit. Voluptas molestiae ipsa cumque odio soluta praesentium?
    </p>
  </div>
</div>
<?php require_once('../inc/templates/footer.php') ?>
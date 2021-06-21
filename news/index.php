<?php
$title = 'News';

require_once('../inc/templates/header.php');

require_once(__DIR__ . '/../inc/services/PostService.php');
$all_posts = PostService::get_all();
?>

<div class="container py-5">
  <div class="py-5">
    <h1>News</h1>
    <div class="row">
      <div class="col-md-8 col-lg-9">
        <?php foreach ($all_posts as $post) : ?>
        <div class="article-preview">
          <h2 class="mb-0 text-capitalize"><?= $post['title'] ?></h2>
          <span
            class="badge gradient-pinkorange mb-1"><?= date_format(new DateTime($post['publish_date']), 'd M, Y') ?></span>
          <p>
            <?= $post['excerpt'] ?>
            <br>
            <a href="/news/article?id=<?= $post['id'] ?>">[Read More]</a>
          </p>
        </div>
        <hr>
        <?php endforeach; ?>
      </div>
      <div class="col-md-4 col-lg-3">
        <a href="/external" target="__blank" rel="noopener">
          <img src="/static/img/upsilon-advert.png" class="w-100 border border-primary" alt="Upsilon Advert">
        </a>
      </div>
    </div>
  </div>
</div>
<?php require_once('../inc/templates/footer.php') ?>
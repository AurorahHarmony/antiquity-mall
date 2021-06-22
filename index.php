<?php

$title = 'Home';

require_once('inc/templates/header.php') ?>

<!-- Call to Action -->
<div id="cta" class="py-5">
  <div class="video-wrapper">
    <video autoplay loop muted>
      <source src="/static/video/cta-promo.m4v" type="video/mp4" />
    </video>
  </div>
  <div class="container">
    <?php include('inc/components/home/get-connected.php') ?>
  </div>
</div>

<!-- News Feed -->
<?php
require_once(__DIR__ . '/inc/services/PostService.php');
$latest_posts = PostService::get_all('publish_date', 'DESC', 3);
?>

<div id="newsFeed" class="py-5">
  <div class="container">
    <h2 class="text-center mb-4">Latest News</h2>

    <div class="splide">
      <div class="splide__track">
        <ul class="splide__list">
          <?php foreach ($latest_posts as $post) : ?>
          <li class="splide__slide">
            <div class="row justify-content-center">
              <!-- <div class="col-md-4 col-lg-3 order-md-2">
                <div style="background-color: rgb(54, 54, 54); width: 100%; height: 200px"></div>
              </div> -->
              <div class="col-md-8 col-lg-6 order-md-1">
                <h2 class="mb-0"><?= $post['title'] ?></h2>
                <span
                  class="badge gradient-pinkorange mb-1"><?= date_format(new DateTime($post['publish_date']), 'd M, Y') ?></span>
                <p><?= $post['excerpt'] ?> <a href="/news/article?id=<?= $post['id'] ?>">[Read More]</a></p>
              </div>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Features -->
<img src="/static/img/features-crop-top.svg" width="100%" style="margin-bottom: -2px" />
<div id="features" class="bg-lavender py-5">
  <div class="container features-container p-5">

    <div class="row text-center">

      <div class="col-sm-6 col-md-4">
        <img src="/static/img/features-icons/keyboard.svg" alt="Keyboard"
          style="max-width: 100%; height: 150px; margin-bottom: 1.5rem">
        <p class="h2">Accessible</p>
        <p>Don't Have a VR Headset? Dreamscape can be played with a Keyboard, Mouse, Or Controller.</p>
      </div>
      <div class="col-sm-6 col-md-4">
        <img src="/static/img/features-icons/global-network.svg" alt="Network"
          style="max-width: 100%; height: 150px; margin-bottom: 1.5rem">
        <p class="h2">Social Metaverse</p>
        <p>Arcades, Shopping Districts, Customizable Apartments, Mini Games and More.</p>
      </div>
      <div class="col-sm-6 col-md-4">
        <img src="/static/img/features-icons/user-interface.svg" alt="User Interface"
          style="max-width: 100%; height: 150px; margin-bottom: 1.5rem">
        <p class="h2">Easy to Use</p>
        <p>Intuitive customisation and tools designed for use by gamers who aren't necessarily developers.</p>
      </div>
    </div>

  </div>
</div>
<img src="/static/img/features-crop-bottom.svg" width="100%" style="margin-top: -2px" />

<!-- Social -->
<div id="socials" class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8 pe-md-4 d-flex">
        <div class="align-self-center">
          <h2>Socials</h2>
          <p>Join in with the community and keep updated, or show your support through patreon.</p>
          <div class="social-buttons">
            <div class="row justify-content-center px-3 px-md-0 mb-3 mb-md-auto">
              <div class="col-6 col-lg-4">
                <a href="https://twitter.com/theDreamscape" target="__blank" rel="noopener"><img
                    src="/static/img/social-twitter.png" alt="Dreamscape's Twitter" /></a>
              </div>
              <div class="col-6 col-lg-4">
                <a href="/external" target="__blank" rel="noopener"><img src="/static/img/social-youtube.png"
                    alt="Dreamscape's YouTube" /></a>
              </div>
              <div class="col-6 col-lg-4">
                <a href="/external" target="__blank" rel="noopener"><img src="/static/img/social-patreon.png"
                    alt="Dreamscape's Patreon" /></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <a class="twitter-timeline" data-width="100%" data-height="300" data-theme="dark"
          href="https://twitter.com/theDreamscape?ref_src=twsrc%5Etfw">Tweets by theDreamscape</a>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
      </div>
    </div>
  </div>
</div>

<!-- Live Player Count -->
<div id="playerCount" class="gradient-nightblue text-white py-5">
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="row justify-content-center text-center">
          <div class="col-auto px-5">
            <p class="player-count-number">194</p>
            <p class="fs-2">Players</p>
          </div>
          <div class="col-auto px-5">
            <p class="player-count-number"><span class="start-zero">0</span>72</p>
            <p class="fs-2">Online</p>
          </div>
        </div>
      </div>
    </div>
    <?php include('inc/components/home/get-connected.php') ?>
  </div>
</div>

<!-- News Slider -->
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
<script>
new Splide('.splide', {
  type: 'loop',
  autoplay: true,
  rewind: true,
  speed: 1000,
  arrows: false,
}).mount();
</script>


<?php require_once('inc/templates/footer.php') ?>
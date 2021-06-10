<?php require_once('inc/templates/header.php') ?>

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
<div id="newsFeed" class="py-5">
  <div class="container">
    <div class="splide">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide">
            <div class="row justify-content-center">
              <div class="col-md-4 col-lg-3 order-md-2">
                <div style="background-color: rgb(54, 54, 54); width: 100%; height: 200px"></div>
              </div>
              <div class="col-md-8 col-lg-6 order-md-1">
                <h2 class="mb-0">News Feed Title 1</h2>
                <span class="badge gradient-pinkorange mb-1">1 Jan, 2020</span>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus totam repellendus possimus hic
                  aliquid praesentium, obcaecati perspiciatis. Deserunt libero, error explicabo ratione laborum, tempora
                  nulla ipsam nobis, porro possimus quisquam!... <a href="#">[Read More]</a></p>
              </div>
            </div>
          </li>

          <li class="splide__slide">
            <div class="row justify-content-center">
              <div class="col-md-4 col-lg-3 order-md-2">
                <div style="background-color: rgb(82, 12, 72); width: 100%; height: 200px"></div>
              </div>
              <div class="col-md-8 col-lg-6 order-md-1">
                <h2 class="mb-0">News Feed Title 2</h2>
                <span class="badge gradient-pinkorange mb-1">1 Jan, 2020</span>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus totam repellendus possimus hic
                  aliquid praesentium, obcaecati perspiciatis. Deserunt libero, error explicabo ratione laborum, tempora
                  nulla ipsam nobis, porro possimus quisquam!... <a href="#">[Read More]</a></p>
              </div>
            </div>
          </li>

          <li class="splide__slide">
            <div class="row justify-content-center">
              <div class="col-md-4 col-lg-3 order-md-2">
                <div style="background-color: rgb(0, 58, 97); width: 100%; height: 200px"></div>
              </div>
              <div class="col-md-8 col-lg-6 order-md-1">
                <h2 class="mb-0">News Feed Title 3</h2>
                <span class="badge gradient-pinkorange mb-1">1 Jan, 2020</span>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus totam repellendus possimus hic
                  aliquid praesentium, obcaecati perspiciatis. Deserunt libero, error explicabo ratione laborum, tempora
                  nulla ipsam nobis, porro possimus quisquam!... <a href="#">[Read More]</a></p>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Features -->
<img src="/static/img/features-crop-top.svg" width="100%" style="margin-bottom: -2px" />
<div id="features" class="bg-lavender py-5">
  <div class="container features-container p-5">
    <div class="row justify-content-center">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <p class="h2">Feature</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt soluta eligendi consequatur corrupti eius vitae
          quod quidem ut facilis voluptas dolores, veritatis similique dolorum exercitationem possimus eum magni
          reprehenderit impedit?</p>
      </div>
    </div>
    <hr />
    <div class="row justify-content-center">
      <div class="col-md-6">
        <p class="h2">Feature</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt soluta eligendi consequatur corrupti eius vitae
          quod quidem ut facilis voluptas dolores, veritatis similique dolorum exercitationem possimus eum magni
          reprehenderit impedit?</p>
      </div>
      <div class="col-md-3"></div>
    </div>
    <hr />
    <div class="row justify-content-center">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <p class="h2">Feature</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt soluta eligendi consequatur corrupti eius vitae
          quod quidem ut facilis voluptas dolores, veritatis similique dolorum exercitationem possimus eum magni
          reprehenderit impedit?</p>
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
            <div class="row justify-content-center">
              <div class="col-sm-6 col-xl-4">
                <a href="#"><img src="/static/img/social-twitter.png" alt="Dreamscape's Twitter" /></a>
              </div>
              <div class="col-sm-6 col-xl-4">
                <a href="#"><img src="/static/img/social-youtube.png" alt="Dreamscape's YouTube" /></a>
              </div>
              <div class="col-sm-6 col-xl-4">
                <a href="#"><img src="/static/img/social-patreon.png" alt="Dreamscape's Patreon" /></a>
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
  type: 'fade',
  autoplay: true,
  rewind: true,
  speed: 1000,
  arrows: false,
}).mount();
</script>


<?php require_once('inc/templates/footer.php') ?>
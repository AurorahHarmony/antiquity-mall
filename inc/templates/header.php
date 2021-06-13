<?php

// Enable Error Messages
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($title)) {
  $title .= ' | ';
} else {
  $title = '';
}

if (!isset($_SESSION)) {
  session_start();
}

function account_dropdown($add_w_class = false)
{
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) : ?>
<li class="nav-item dropdown<?php echo $add_w_class ? ' w-50' : '' ?>">
  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
    aria-expanded="false">
    <?php echo $_SESSION['username'] ?? 'Username'; ?> +
  </a>
  <ul class="dropdown-menu dropdown-menu-end text-md-end" aria-labelledby="navbarDropdown">
    <li><a class="dropdown-item" href="/account">My Account</a></li>
    <li><a class="dropdown-item" href="/account/downloads">My Downloads</a></li>
    <li>
      <hr class="dropdown-divider">
    </li>
    <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
  </ul>
</li>
<?php else : ?>
<li class="nav-item<?php echo $add_w_class ? ' w-50' : '' ?>">
  <a class="nav-link" href="/account">Account</a>
</li>
<?php
  endif;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $title ?>DreamScape</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/@splidejs/splide@2.4.21/dist/css/splide.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/static/css/theme.min.css" />

  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet" />
</head>

<body>
  <!-- Navbar -->
  <nav id="mainNavbar" class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container-lg">
      <!-- Desktop Left Nav -->
      <div class="collapse navbar-collapse" id="navLeft">
        <ul class="navbar-nav w-100 mb-2 mb-lg-0">
          <li class="nav-item w-50">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item w-50">
            <a class="nav-link" href="/news">News</a>
          </li>
        </ul>
      </div>

      <!-- Logo -->
      <div class="navbar-brand mx-lg-auto">
        <a href="/">
          <div class="navbar-brand-bg">
            <img src="/static/img/logo-2.svg" alt="Dreamscape Logo" />
          </div>
        </a>
      </div>

      <!-- Desktop Right Nav -->
      <div class="collapse navbar-collapse" id="navRight">
        <ul class="navbar-nav w-100 text-end mb-2 mb-lg-0 ms-auto">
          <li class="nav-item w-50">
            <a class="nav-link" href="/external">Forum</a>
          </li>
          <?php account_dropdown(true) ?>
        </ul>
      </div>

      <!-- Navbar Toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav"
        aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Mobile Navigation Menu -->
      <div class="collapse navbar-collapse" id="mobileNav">
        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/news">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/external">Forum</a>
          </li>
          <?php account_dropdown() ?>
        </ul>
      </div>
    </div>
  </nav>
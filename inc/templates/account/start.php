<?php
$tab_name = $tab_name ?? 'account';
?>

<div class="container py-5">
  <div class="py-5">
    <h1>Account</h1>
    <div class="row">
      <div class="col-md-4 col-lg-3">
        <ul class="nav nav-pills flex-column mb-3 mb-md-0">
          <li class="nav-item">
            <a href="/account" class="nav-link <?php echo ($tab_name == 'account') ? 'active' : '' ?>">
              <i class="bi bi-house-fill"></i> Account Home
            </a>
          </li>
          <li class="nav-item">
            <a href="/account/profile" class="nav-link <?php echo ($tab_name == 'profile') ? 'active' : '' ?>">
              <i class="bi bi-person-fill"></i> My Profile
            </a>
          </li>
          <li class="nav-item">
            <a href="/account/downloads" class="nav-link <?php echo ($tab_name == 'downloads') ? 'active' : '' ?>">
              <i class="bi bi-cloud-arrow-down-fill"></i> Downloads
            </a>
          </li>
          <li class="nav-item">
            <hr>
          </li>
          <li class="nav-item">
            <a href="/logout" class="nav-link text-danger">
              <i class="bi bi-box-arrow-left"></i> Logout
            </a>
          </li>
        </ul>
      </div>
      <div class="col-md-8 col-lg-9">
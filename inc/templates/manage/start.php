<?php
$tab_name = $tab_name ?? 'dashboard';
?>

<style>
.btn-toggle-nav a {
  display: inline-flex;
  padding: .1875rem .5rem;
  margin-top: .125rem;
  margin-left: 1.25rem;
  text-decoration: none;
}

.btn {
  padding: .25rem .5rem;
  font-weight: 600;
  color: rgba(0, 0, 0, .65);
  background-color: transparent;
  border: 0;
}

.btn .btn-toggle {
  display: inline-block;
  transition: transform .35s ease;
  transform-origin: .6em 50%;
}

.btn[aria-expanded="true"] .btn-toggle {
  transform: rotate(90deg);
}

/* .btn-toggle::before {
  width: 1.25em;
  line-height: 0;
  content: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e);
  transition: transform .35s ease;
  transform-origin: .5em 50%;
} */
</style>

<div class="container py-5">
  <div class="py-5">
    <h1>Management</h1>
    <div class="row">
      <div class="col-md-4 col-lg-3">
        <ul class="list-unstyled ps-0">
          <li class="mb-1">
            <a href="/manage" class="btn align-items-center rounded">
              Dashboard
            </a>

          </li>
          <li class="mb-1">
            <button class="btn align-items-center rounded" data-bs-toggle="collapse" data-bs-target="#news-collapse"
              aria-expanded="false">
              <i class="bi bi-caret-right-fill btn-toggle"></i> News
            </button>
            <div class="collapse" id="news-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="link-dark rounded">All Posts</a></li>
                <li><a href="#" class="link-dark rounded">New Post</a></li>
              </ul>
            </div>
          </li>
          <li class="mb-1">
            <button class="btn align-items-center rounded" data-bs-toggle="collapse" data-bs-target="#users-collapse"
              aria-expanded="false">
              <i class="bi bi-caret-right-fill btn-toggle"></i> User Management
            </button>
            <div class="collapse" id="users-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="link-dark rounded">Active Users</a></li>
                <li><a href="#" class="link-dark rounded">Banned Users</a></li>
              </ul>
            </div>
          </li>
          <li class="mb-1">
            <button class="btn align-items-center rounded" data-bs-toggle="collapse"
              data-bs-target="#downloads-collapse" aria-expanded="false">
              <i class="bi bi-caret-right-fill btn-toggle"></i> Download Management
            </button>
            <div class="collapse" id="downloads-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="link-dark rounded">Version Management</a></li>
                <li><a href="#" class="link-dark rounded">Upload Version</a></li>
              </ul>
            </div>
          </li>

        </ul>
      </div>
      <div class="col-md-8 col-lg-9">
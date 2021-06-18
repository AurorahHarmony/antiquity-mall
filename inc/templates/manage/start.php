<?php
//This is here for security incase another manager file accidentally misses it
require_once(__DIR__ . '/../../handlers/SessionHandler.php');
$session = new Session;
$session->protected_route('ACCESS_MANAGER', true);

$title = $title ?? 'Site Management';

require_once(__DIR__ . '/../../templates/header.php');

$tab_name = $tab_name ?? 'dashboard';
require_once(__DIR__ . '/../../classes/URI.php');
$uri = new URI;
?>

<style>
.btn-toggle-nav a {
  display: inline-flex;
  padding: .1875rem .5rem;
  margin-top: .125rem;
  margin-left: 1.25rem;
  text-decoration: none;
}

.sidebar .btn {
  padding: .25rem .5rem;
  font-weight: 600;
  color: rgba(0, 0, 0, .65);
  background-color: transparent;
  border: 0;
}

.sidebar .btn .btn-toggle {
  display: inline-block;
  transition: transform .35s ease;
  transform-origin: .6em 50%;
}

.sidebar .btn[aria-expanded="true"] .btn-toggle {
  transform: rotate(90deg);
}
</style>

<div class="container py-5">
  <div class="py-5">
    <h1>Management</h1>
    <div class="row">
      <div class="col-md-4 col-lg-3">
        <ul class="list-unstyled ps-0 sidebar">
          <li class="mb-1">
            <a href="/manage" class="btn align-items-center rounded">
              Dashboard
            </a>

          </li>
          <li class="mb-1">
            <button class="btn align-items-center rounded" data-bs-toggle="collapse" data-bs-target="#news-collapse"
              aria-expanded="<?= $uri->matches(['/manage/posts', '/manage/posts/new'], 'true', 'false') ?>">
              <i class="bi bi-caret-right-fill btn-toggle"></i> News
            </button>
            <div class="collapse <?= $uri->matches(['/manage/posts', '/manage/posts/new'], 'show') ?>"
              id="news-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="/manage/posts" class="link-dark rounded">All Posts</a></li>
                <li><a href="/manage/posts/new" class="link-dark rounded">New Post</a></li>
              </ul>
            </div>
          </li>
          <li class="mb-1">
            <button class="btn align-items-center rounded" data-bs-toggle="collapse" data-bs-target="#users-collapse"
              aria-expanded="<?= $uri->matches(['/manage/users', '/manage/users/edit-roles'], 'true', 'false') ?>">
              <i class="bi bi-caret-right-fill btn-toggle"></i> User Management
            </button>
            <div class="collapse <?= $uri->matches(['/manage/users', '/manage/users/edit-roles'], 'show') ?>"
              id="users-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="/manage/users" class="link-dark rounded">All Users</a></li>
                <li><a href="/manage/users/edit-roles" class="link-dark rounded">Role Editor</a></li>
              </ul>
            </div>
          </li>
          <li class="mb-1">
            <button class="btn align-items-center rounded" data-bs-toggle="collapse"
              data-bs-target="#downloads-collapse"
              aria-expanded="<?= $uri->matches(['/manage/downloads/windows', '/manage/downloads/mac'], 'true', 'false') ?>">
              <i class="bi bi-caret-right-fill btn-toggle"></i> Download Management
            </button>
            <div class="collapse <?= $uri->matches(['/manage/downloads/windows', '/manage/downloads/mac'], 'show') ?>"
              id="downloads-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="/manage/downloads/windows" class="link-dark rounded">Windows</a></li>
                <li><a href="/manage/downloads/mac" class="link-dark rounded">Mac</a></li>
              </ul>
            </div>
          </li>

        </ul>
      </div>
      <div class="col-md-8 col-lg-9">
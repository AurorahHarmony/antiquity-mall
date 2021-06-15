<?php
class Session
{
  public function __construct()
  {
    if (!isset($_SESSION)) {
      session_start();
    }
  }

  public function protected_route()
  {
    if ($_SESSION['logged_in'] != true || empty($_SESSION['id'])) {
      http_response_code(403);
      header('location: /login');
      exit;
    }
  }

  /**
   * Login a user
   * @param int $user_id The ID for the user that is being logged in.
   * @param string $username The user's username
   */
  public function login($user_id = null, $username = null)
  {
    if (!is_int($user_id)) {
      throw new Error('Invalid User ID');
    }

    if (empty($username)) {
      throw new Error('Invalid Username');
    }

    //Check if the User is allowed to login
    require_once(__DIR__ . '/../services/PermissionService.php');

    $user_perms = PermissionService::has_perm($user_id, 'LOGIN', true);
    if (!$user_perms) {
      throw new Error("You do not have permission to login.");
    }

    $_SESSION['id'] = $user_id;
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['perms'] = $perms;
  }
}
<?php
class Session
{
  public function __construct()
  {
    if (!isset($_SESSION)) {
      session_start();
    }
  }

  /**
   * @param string $required_perm A permission that is required to view this route
   * @param bool $get_fresh Should we force the system to get fresh user perms from the database?
   */

  public function protected_route($required_perm = null, $get_fresh = false)
  {

    if ($required_perm == null) {
      if ($_SESSION['logged_in'] != true || empty($_SESSION['id'])) {
        http_response_code(403);
        header('location: /login');
        exit;
      }
    } else {
      if ($_SESSION['logged_in'] != true || empty($_SESSION['id'])) {
        http_response_code(404);
        header('location: /404');
        exit;
      } else {
        require_once(__DIR__ . '/../services/PermissionService.php');
        $user_perms = PermissionService::has_perm($required_perm, $_SESSION['id'], $get_fresh);
        if ($user_perms == false) {
          http_response_code(404);
          header('location: /404');
          exit;
        }
      }
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

    $user_perms = PermissionService::has_perm('LOGIN', $user_id, true);
    if (!$user_perms) {
      throw new Error("You do not have permission to login.");
    }

    $_SESSION['id'] = $user_id;
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['perms'] = $user_perms;
  }
}
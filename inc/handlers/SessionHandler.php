<?php
class Session
{
  public function __construct()
  {
    session_start();
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
      throw new Error('The user ID must be an Integer!');
    }

    if (empty($username)) {
      throw new Error('The Username cannot be empty!');
    }

    $_SESSION['id'] = $user_id;
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
  }
}

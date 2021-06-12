<?php

require_once(__DIR__ . '/Database.php');
require_once(__DIR__ . '/../classes/FormHandler.php');

class UserService
{

  /**
   * @param string $username The user's username
   * @param string $email The user's email
   * @param string $password blep
   * @param string $password_confirm
   * @return bool True if the user creation was successful
   */
  static function create($username = null, $email = null, $password = null, $password_confirm = null)
  {
    // throw new Exception();

    // $db = new Database;

    // $results = $db->select('SELECT * FROM test WHERE id = :id', ['id' => '2']);
    // print_r($results);
  }

  /**
   * @param Form $form A form class with a username and password value
   * @return boolean Returns true if validated
   */
  static function validate(Form $form)
  {
    $username = $form->get_value('username');
    $password = $form->get_value('password');

    $error_text = 'Invalid Credentials';

    //If a field is empty, return an error
    if (empty($username) || empty($password)) {
      $form->general_error = $error_text;
      return false;
    }

    $db = new Database;
    $users = $db->select('SELECT * FROM users WHERE username = :username', ['username' => $username]);

    //If no username match was found, return an error
    if (empty($users)) {
      $form->general_error = $error_text;
      return false;
    }

    //If the found user does not have a matching password, return an error
    $the_user = $users[0];
    if ($the_user['password'] != $password) {
      $form->general_error = $error_text;
      return false;
    }

    try {
      require_once(__DIR__ . '/../handlers/SessionHandler.php');
      $session = new Session;
      $session->login((int) $the_user['id'], $the_user['username']);
      return true;
    } catch (\Throwable $th) {
      $form->general_error = 'Internal Server Error ';
      return false;
    }
  }
}

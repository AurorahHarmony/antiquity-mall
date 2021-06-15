<?php
require_once(__DIR__ . '/Database.php');
class PermissionService
{

  public static function get_perms($user_id)
  {
    $db = new Database;
    $permissions = $db->select(
      'SELECT permissions.perm_name FROM users 
	      JOIN roles ON roles.role_id = users.role_id
        JOIN roles_permissions ON roles_permissions.role_id = roles.role_id
        JOIN permissions ON permissions.perm_id = roles_permissions.perm_id
        WHERE users.id = :user_id
    ',
      ['user_id' => $user_id]
    );

    $perm_array = [];
    foreach ($permissions as $permission) {
      array_push($perm_array, $permission['perm_name']);
    }
    return $perm_array;
  }

  public static function has_perm($user_id, $perm_name, $get_fresh = true)
  {
    $user_perms = self::get_perms($user_id);

    if (array_search($perm_name, $user_perms) === false) {
      return false;
    } else {
      return true;
    }
  }
}
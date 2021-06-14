<?php

require_once(__DIR__ . '/Database.php');
require_once(__DIR__ . '/../classes/FormHandler.php');

class PostService
{

  /**
   * @param Form $form Takes a form class object with title, user_id and content keys.
   * @return bool True if the post is sucessfully created
   */
  static function create(Form $form)
  {
    $title = trim($form->get_value('title'));
    $user_id = $form->get_value('user_id');
    $content = $form->get_value('content');

    if (empty($title)) {
      $form->add_error('title', 'The post must have a title');
    }

    if (empty($content)) {
      $form->add_error('content', 'You can not make an empty post!');
    }

    if ($form->has_errors()) {
      return false;
    }

    //Sanitize the Title
    $sanitized_title = htmlspecialchars($title);

    //Sanitize the Content
    $allowedTags = '<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
    $allowedTags .= '<li><ol><ul><span><div><br><ins><del>';
    $sanitized_content = strip_tags(stripslashes($content), $allowedTags);

    //Create the Post
    try {
      $db = new Database;
      $db->insert('posts', [
        'title' => $sanitized_title,
        'author_id' => $user_id,
        'content' => $content
      ]);

      return true;
    } catch (\Throwable $th) {
      $form->general_error = 'Internal Server Error - ' . $th;
      return false;
    }
  }

  public static function get_all()
  {
    $db = new Database;
    $all_posts = $db->select('SELECT * FROM posts');
    return $all_posts;
  }
}
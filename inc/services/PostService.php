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
    self::validate_post_fields($form);

    if ($form->has_errors()) {
      return false;
    }

    $sanitized_input = self::sanitize_post_fields($form);
    $san_title = $sanitized_input['title'];
    $san_content = $sanitized_input['content'];

    $user_id = $form->get_value('user_id');

    //Create the Post
    try {
      $db = new Database;
      $db->insert('posts', [
        'title' => $san_title,
        'author_id' => $user_id,
        'content' => $san_content
      ]);

      return true;
    } catch (\Throwable $th) {
      $form->general_error = 'Internal Server Error - ' . $th;
      return false;
    }
  }

  /**
   * @param int $post_id The ID of the post that you want to update
   * @param Form $form a Form object with a title and content key
   * @return bool True if the post is sucessfully updated
   */
  public static function update($post_id, Form $form)
  {
    self::validate_post_fields($form);

    if ($form->has_errors()) {
      return false;
    }

    $sanitized_input = self::sanitize_post_fields($form);
    $san_title = $sanitized_input['title'];
    $san_content = $sanitized_input['content'];

    //Update the post
    try {
      $db = new Database;
      $db->update('posts', ['title' => $san_title, 'content' => $san_content], 'id = :post_id', ['post_id' => $post_id]);
      return true;
    } catch (\Throwable $th) {
      $form->general_error = 'Internal Server Error - ' . $th;
      return false;
    }
  }

  /**
   * @param Form $form The form object to be validated
   */
  private static function validate_post_fields(Form $form)
  {
    $title = trim($form->get_value('title'));
    $content = $form->get_value('content');

    if (empty($title)) {
      $form->add_error('title', 'The post must have a title');
    }

    if (empty($content)) {
      $form->add_error('content', 'You can not make an empty post!');
    }
  }

  /**
   * Sanitizes the title and content fields for a form
   * @param Form $form The form object to sanitize
   * @return array ['sanitized_title', 'sanitized_content']
   */
  private static function sanitize_post_fields(Form $form)
  {
    //Sanitize the Title
    $title = trim($form->get_value('title'));
    $sanitized_title = htmlspecialchars($title);

    //Sanitize the Content
    $content = $form->get_value('content');
    $allowedTags = '<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
    $allowedTags .= '<li><ol><ul><span><div><br><ins><del>';
    $sanitized_content = strip_tags(stripslashes($content), $allowedTags);

    return [
      'title' => $sanitized_title,
      'content' =>  $sanitized_content
    ];
  }

  /**
   * Gets all posts
   * @return array of All posts
   */
  public static function get_all()
  {
    $db = new Database;
    $all_posts = $db->select('SELECT * FROM posts');
    return $all_posts;
  }

  /**
   * @param int $post_id The ID of the post that you want to find
   * @return array|bool False if no post was found
   */
  public static function get_one($post_id)
  {
    $db = new Database;
    $found_post = $db->select('SELECT * FROM posts WHERE id = :id', ['id' => $post_id]);
    if (count($found_post) > 0) {
      return $found_post[0];
    } else {
      return false;
    }
  }
}
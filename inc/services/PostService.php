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
    $san_excerpt = $sanitized_input['excerpt'];
    $san_content = $sanitized_input['content'];

    $user_id = $form->get_value('user_id');

    //Create the Post
    try {
      $db = new Database;
      $db->insert('posts', [
        'title' => $san_title,
        'author_id' => $user_id,
        'excerpt' => $san_excerpt,
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
    $san_excerpt = $sanitized_input['excerpt'];
    $san_content = $sanitized_input['content'];

    // echo $san_excerpt;
    // return false;

    if ($form->has_errors()) {
      return false;
    } else {
      //Update the post
      try {
        $db = new Database;
        $db->update('posts', ['title' => $san_title, 'excerpt' => $san_excerpt, 'content' => $san_content], 'id = :post_id', ['post_id' => $post_id]);
        return true;
      } catch (\Throwable $th) {
        $form->general_error = 'Internal Server Error - ' . $th;
        return false;
      }
    }
  }

  /**
   * @param Form $form The form object to be validated
   */
  private static function validate_post_fields(Form $form)
  {
    $title = trim($form->get_value('title'));
    $excerpt = trim($form->get_value('excerpt'));
    $content = $form->get_value('content');

    if (empty($title)) {
      $form->add_error('title', 'The post must have a title');
    }

    if (empty($excerpt)) {
      $form->add_error('excerpt', 'The excerpt cannot be empty');
    }

    if (strlen($excerpt) > 255) {
      $form->add_error('excerpt', 'The excerpt must be less than 255 characters');
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

    //Sanitize the Excerpt
    $excerpt = trim($form->get_value('excerpt'));
    $sanitized_excerpt = strip_tags(stripslashes($excerpt));

    //Sanitize the Content
    $content = $form->get_value('content');
    $allowedTags = '<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
    $allowedTags .= '<li><ol><ul><span><div><br><ins><del>';
    $sanitized_content = strip_tags(stripslashes($content), $allowedTags);

    return [
      'title' => $sanitized_title,
      'content' =>  $sanitized_content,
      'excerpt' => $sanitized_excerpt
    ];
  }

  /**
   * Gets all posts
   * @param string $order_by_column The Column name to order the search by
   * @param string[DESC|ASC] $order_by_order The Order in which to order by 
   * @return array of All posts
   */
  public static function get_all($order_by_column = 'publish_date', $order_by_order = 'DESC')
  {
    //Secure Column to Order by param
    $columns = ['publish_date', 'id'];
    $column_key = array_search($order_by_column, $columns);
    $order_column = $columns[$column_key];

    //Secure Order direction param
    $directions = ['DESC', 'ASC'];
    $direction_key = array_search($order_by_order, $directions);
    $order_direction = $directions[$direction_key];

    $db = new Database;
    $all_posts = $db->select("SELECT * FROM posts ORDER BY $order_column $order_direction");
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

  public static function delete($post_id)
  {
    try {
      $db = new Database;
      $deleted = $db->delete('posts', 'id = :id', ['id' => $post_id]);
      return $deleted;
    } catch (\Throwable $th) {
      return 'Internal Server Error';
    }
  }
}
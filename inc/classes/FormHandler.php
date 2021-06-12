<?php

class Form
{

  private $data = [];
  /**
   * @var string A general error message to be shown to the user
   */
  public $general_error = '';

  /**
   * @param array $inputs An Associative array where the key is the input name and the value is its value
   */
  public function __construct(array $inputs = [])
  {
    foreach ($inputs as $name => $value) {
      $this->data[$name]['value'] = $value;
      $this->data[$name]['errors'] = [];
    }
  }

  /**
   * @param string $input_name The name of the input you want to get the value of
   * @return string The value of the input
   */
  public function get_value($input_name)
  {
    return $this->data[$input_name]['value'];
  }

  /**
   * @param string $input_name The name of the input you want to get the value of
   * @param string $error_text An error message for this input
   */
  public function add_error($input_name, $error_text)
  {
    $this->data[$input_name]['errors'][] = $error_text;
  }

  /**
   * @param string $input_name The name of the input you want to get the value of
   * @return array All errors associated with this field
   */
  public function errors($input_name)
  {
    return $this->data[$input_name]['errors'];
  }

  /**
   * @param string $input_name (optional) The name of the input to check. If no input name is added, it will check all inputs for errors
   * @return bool True if any errors were found
   */
  public function has_errors($input_name = null)
  {

    if (!empty($input_name) && !empty($this->errors($input_name))) {
      return true;
    } else {
      if (!empty($general_error)) {
        return true;
      }

      $has_any_error = false;
      foreach ($this->data as $input) {
        if (!empty($input['errors'])) {
          $has_any_error = true;
          break;
        }
      }
      return $has_any_error;
    }
  }

  /**
   * @param string $input_name The name of the input to get the valid class for
   * @param boolean $only_invalid (optional) Set to true if you only want to show when a field is invalid
   */
  public function echo_valid_class($input_name, $only_invalid = false)
  {
    if (!empty($this->data[$input_name]['errors'])) {
      echo 'is-invalid';
      return;
    }

    if ($only_invalid == false && !empty($this->data[$input_name]['value'])) {
      echo 'is-valid';
    }
  }

  public function echo_formatted_errors($input_name)
  {
    $error_format = '<div class="invalid-feedback">%s</div>';
    foreach ($this->data[$input_name]['errors'] as $error) {
      echo "<div class='invalid-feedback'>{$error}</div>";
    }
  }
  public function echo_formatted_general_error()
  {
    if (!empty($this->general_error)) {
      echo "<div class='alert alert-danger' role='alert'>{$this->general_error}</div>";
    }
  }
}

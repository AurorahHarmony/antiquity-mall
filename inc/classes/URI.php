<?php
class URI
{
  public $the_uri;

  public function  __construct()
  {
    $this->the_uri = $_SERVER['REQUEST_URI'];
  }

  /**
   * @param array $uri_list An array of URI that you'd like to check for
   * @param string $true_return_string A string you'd like returned if the URI is found
   * @param string $false_return_string A string you'd like returned if false
   * @return bool True if the current URI was found in the list
   */
  public function matches($uri_list = [], $true_return_string = '', $false_return_string = '')
  {
    $uri_found = false;

    foreach ($uri_list as $searched_uri) {
      if (strpos($this->the_uri, $searched_uri) !== false) {
        $uri_found = true;
        break;
      }
    }

    if (empty($true_return_string)) {
      return $uri_found;
    } else {
      if ($uri_found) {
        return $true_return_string;
      } else {
        return $false_return_string;
      }
    }
  }
}
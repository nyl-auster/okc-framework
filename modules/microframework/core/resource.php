<?php
/**
 * @file
 *
 * Base class for resources.
 *
 * All content displayed by this framework is a resource object.
 *
 * A resource may be accessible by an url if it's registered in "routes.php" file.
 * Otherwise, instanciate a resource by yourself and use render() method to display it,
 * as render() takes care of access.
 *
 * The only required method to create a resource is content() from now, which must
 * return html, json or any final representation ready to display on a page.
 */
namespace microframework\core;

abstract class resource {

  /**
   * if FALSE, resource will not be visible. 
   */
  function access() {
    return TRUE;
  }

  /**
   * response to a post request.
   * Return the get page by default.
   */
  function post() {
    return $this->get();
  }


  /**
   * Response to a get request 
   */
  abstract function get();

  /**
   * Render the content of the resource, checking access to this resource.
   */
  function render() {
    if ($this->access() == TRUE) {
      if (isset($_POST)) {
        return $this->post();
      }
      else {
        return $this->get();
      }
    }
    else {
      return '';
    }
  }

}


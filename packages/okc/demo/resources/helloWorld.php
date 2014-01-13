<?php
// define namespace to allow PSR-0 autoload of our class
// {vendorName}/{namespace}, where namespace reflect the directory structure.
// Here we say autoloader to look in /okc/example/resources directory to find our class.
namespace okc\demo\resources;

use okc\resource\resource;
use okc\view\view;
use okc\i18n\i18n;

/**
 * Extends framework abstract resource.
 */
class helloWorld extends resource {

  /**
   * Get is a mandatory method, it has to return content to the framework.
   * here we set a parent view, so that helloWorld.php is inserted inside
   * the global layout.php template, and also some variables that could have
   * been bring by our model.
   */
  function get() {
    $variables = array(
      'content' => i18n::t('hello.world.test.page'),
    );
    $view = new view('packages/okc/demo/views/helloWorld.php', $variables);
    $view->setParentView('packages/okc/demo/views/layout.php');
    return $view;
  }

}


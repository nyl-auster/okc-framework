<?php
/**
 * @file
 * Events Manager
 *
 */
namespace microframework\core;

class eventsManager {

  static protected $instance = null;
  protected $listeners = [];

  /**
   * @param array $listeners
   *   associative array mapping listeners to events. example :
   * $listeners = [
   *   'event.name' = [
   *     'listener.name' = ['callable' => 'my\class::myMethod'],
   *     'listener2.name' = ['callable' => 'my\class::myMethod2'],
   *   ],
   * ];
   */
  private function __construct($listeners) {
    $this->listeners = $listeners;
  }

  static public function getListeners() {
    return $this->listeners;
  }

  static public function getInstance($listeners) {
    if (!self::$instance) {
      self::$instance = new self($listeners);
    }
    return self::$instance;
  }

  /**
   * Dispatch an event in application
   * @event (string)
   *   event name
   * @params (mixed)
   *   param to pass to the listener
   */
  public function fire($event, $params = array()) {
    if (!isset($this->listeners[$event])) return false;
    foreach ($this->listeners[$event] as $listener) {
      if (isset($listener['enable']) && $listener['enable'] == FALSE)  {
        continue;
      }
      call_user_func_array($listener['callable'], $params);
    }
  }

}


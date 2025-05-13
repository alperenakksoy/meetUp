<?php

namespace Framework;

class Session{

    /**
     * Start the session
     * @return void
     */

     public static function start() {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
     }
/*
    When we call Session::set('user', [array of data]), here's what's happening:
    The first parameter 'user' is the key or name under which we're storing our data in the session.
    The second parameter [array of data] is the value we're storing - in this case, 
    an associative array with all the user information.
    This approach means all user data is grouped under a single session key named 'user', 
    rather than having separate session keys for each piece of user information.
     * 
     * Set a session key/value pair 
     * @param string $key 
     * @param mixed $value
     * @return void
     */
     public static function set($key, $value){
        $_SESSION[$key] = $value;
     }


       /**
     * GET a session value by the key
     * @param string $key 
     * @param mixed $default
     * @return mixed 
     */
     public static function get($key, $default=null){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
     }
     /**
      * Check If session key is exist
      * @param string $key
      * @return boolean
      */
      public static function has($key){
        return isset($_SESSION[$key]);
          }

      /**
       * Clear session key
       * @param string $key
       * @return void
       */
      public static function clear($key) {
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
      }

    /**
     * Clear all session Data
     * @return void
     */
    public static function clearAll() {
        session_unset();
        session_destroy();
    }
}
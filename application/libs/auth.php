<?php

class Auth {

  public static function isAuthenticated() {
    if(isset($_SESSION["auth"]))
    {
      return true;
    }
    return false;
  }

  public static function logout() {
    foreach ($_SESSION as $key => $value) {
      unset($_SESSION[$key]);
    }
    session_destroy();
  }


}

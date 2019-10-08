<?php

include_once './../includes/db_action.php';

class main_class extends db_action {
  
  function encrypt($string, $key) {
    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key)) - 1, 1);
      $char = chr(ord($char) + ord($keychar));
      $result.=$char;
    }
    return base64_encode($result);
  }

  function decrypt($string, $key) {
    $result = '';
    $string = base64_decode($string);

    for ($i = 0; $i < strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key)) - 1, 1);
      $char = chr(ord($char) - ord($keychar));
      $result.=$char;
    }
    return $result;
  }

  function generate_password($length = 8) {
    $password = "";
    $possible = "0123456789bcdfghjkmnpqrstvwxyz";
    $i = 0;
    while ($i < $length) {
      $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
      if (!strstr($password, $char)) {
        $password .= $char;
        $i++;
      }//end if
    }
    return $password;
  }
}
?>
<?php

function printArray($array) {
  echo "<pre>";
  print_r($array);
  echo "</pre>";
}

function echoMsgArray($array) {
  $result = '';
  foreach($array as $msg) {
    $result .= $msg . '<br>';
  }
  return $result;
}

function setValue($value, $default) {
  if ($value === '') {return $default;}
  return $value;

}

function addMsgs($msgs) {
  $html = '';
  foreach($msgs as $msg) {
    $html .= $msg . "<br>";
  }
  return $html;
}

function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string="") {
  return urlencode($string);
}

function raw_u($string="") {
  return rawurlencode($string);
}

function h($string="") {
  return htmlspecialchars($string);
}

function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

  ?>

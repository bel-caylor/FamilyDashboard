<?php

  define("PRIVATE_PATH", dirname(__FILE__));  //current path to this file
  define("PROJECT_PATH", dirname(PRIVATE_PATH));  //path one directory up
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  define("WWW_ROOT", '/FamilyDashboard/public');

  // require_once('functions.php');
  require_once('database.php');
  require_once('sqlFunctions.php');
  require_once('functions.php');
  require_once('validationFunctions.php');  

  $db = dbConnect();
 ?>

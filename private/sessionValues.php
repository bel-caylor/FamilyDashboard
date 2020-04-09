<?php
// require_once('../private/initialize.php');
  // $_SERVER['REQUEST_METHOD'] = '';
  //Step1
  $_SESSION['familyID'] = $_SESSION['familyID'] ?? '';
  $_SESSION['family'] = $_SESSION['family'] ?? '';
  $_SESSION['step'] = $_SESSION['step'] ?? '1';
  $_SESSION['postalCode'] = $_SESSION['postalCode'] ?? '';
  $_SESSION['step1Msgs'] = $_SESSION['step1Msgs'] ?? [];
  //Step2
  $_SESSION['name'] = $_SESSION['name'] ?? '';
  $_SESSION['initial'] = $_SESSION['initial'] ?? '';
  $_SESSION['color'] = $_SESSION['color'] ?? '';
  $_SESSION['admin'] = $_SESSION['admin'] ?? '';
  $_SESSION['email'] = $_SESSION['email'] ?? '';
  $_SESSION['password'] = $_SESSION['password'] ?? '';
  $_SESSION['userID'] = $_SESSION['userID'] ?? '';
  $_SESSION['currentUserID'] = $_SESSION['currentUserID'] ?? '';
  $_SESSION['currentName'] = $_SESSION['currentName'] ?? '';
  $_SESSION['step2Msgs'] = $_SESSION['step2Msgs'] ?? [];
  $_SESSION['users'] = $_SESSION['users'] ?? [];
  $_SESSION['user'] = $_SESSION['user'] ?? [];
?>


<?php



 ?>

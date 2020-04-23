<?php
// require_once('../private/initialize.php');
  // $_SERVER['REQUEST_METHOD'] = '';
  //Step1
  $_SESSION['familyID'] = $_SESSION['familyID'] ?? '';
  $_SESSION['family'] = $_SESSION['family'] ?? '';
  $_SESSION['step'] = $_SESSION['step'] ?? '1';
  $_SESSION['postalCode'] = $_SESSION['postalCode'] ?? '';
  $_SESSION['step1Msgs'] = $_SESSION['step1Msgs'] ??  array();
  //Step2
  $_SESSION['aryUser'] = $_SESSION['aryUser'] ?? array();
  $_SESSION['email'] = $_SESSION['email'] ?? '';
  $_SESSION['password'] = $_SESSION['password'] ?? '';
  $_SESSION['userID'] = $_SESSION['userID'] ?? '';
  $_SESSION['currentUserID'] = $_SESSION['currentUserID'] ?? '';
  $_SESSION['currentName'] = $_SESSION['currentName'] ?? '';
  $_SESSION['admin'] = 0;
  $_SESSION['step2Msgs'] = $_SESSION['step2Msgs'] ?? array();
  $_SESSION['users'] = $_SESSION['users'] ?? [];
  $_SESSION['user'] = $_SESSION['user'] ?? [];
  //Step3
  $_SESSION['input'] = array();
  $_SESSION['step3Msgs']  = $_SESSION['step3Msgs'] ?? array();
  //step4
  $_SESSION['freq'] = array();
  $_SESSION['category'] = array();
  $_SESSION['step4Msgs']  = $_SESSION['step4Msgs'] ?? array();
  $_SESSION['step5Msgs']  = $_SESSION['step5Msgs'] ?? array();
  $_SESSION['step6Msgs']  = $_SESSION['step6Msgs'] ?? array();
?>


<?php



 ?>

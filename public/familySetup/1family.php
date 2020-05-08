<?php require_once('../../private/initialize.php');

  // $expires = time() + 60*60*24*14; //cookie expires in 2 weeks
  $familyID = $_POST['familyID'] ?? $_SESSION['familyID'] ?? '';
  $family = $_GET['family'] ?? $_POST['family'] ?? $_SESSION['family'] ?? '';
  $postalCode = $_GET['postalCode'] ?? $_POST['postalCode'] ?? $_SESSION['postalCode'] ?? '';
  $step = $_GET['step'] ?? $_POST['step'] ?? $_SESSION['step'] ?? '';
  $_SESSION['step1Msgs'] = array();
  $_SESSION['step2Msgs'] = array();
  $_SESSION['step3Msgs'] = array();
  $_SESSION['step4Msgs'] = array();
  $_SESSION['step5Msgs'] = array();
  $_SESSION['step6Msgs'] = array();

  if ($familyID == '') {
  //Create Family
    $result = sqlCreateFamily(h($family), h($postalCode), $familyID);

    //ERRORS
    if (is_array($result)) {
      $_SESSION['step1Msgs'][] = "Update failed.  Please try again.<br>" . var_dump($result);
      header("Location: " . WWW_ROOT . "/familySetup.php");  //REDIRECT
    }

    $_SESSION['familyID'] = $result;
    $_SESSION['family'] = $_POST['family'] ?? '';
    $_SESSION['postalCode'] = $_POST['postalCode'] ?? '';
    $_SESSION['step'] = '2';
    $_SESSION['step1Msgs'][] = "Family Created.";
    header("Location: " . WWW_ROOT . "/familySetup.php#Step2");  //REDIRECT

    // exit;

  } else {
  //Edit Family
    $result = sqlEditFamily($family, $postalCode, $familyID);
    //ERRORS
    if (is_array($result)) {
      $_SESSION['step1Msgs'][] = "Update failed.  Please try again.<br>" . var_dump($result);
      header("Location: " . WWW_ROOT . "/familySetup.php");  //REDIRECT
    }

    if ($result == "update failed") {
      $_SESSION['step1Msgs'][] = "Update failed.  Please try again.";
    } else {
      $_SESSION['step1Msgs'][] = "Update succeeded.";
      $_SESSION['family'] = $family;
      $_SESSION['postalCode'] = $postalCode;
      header("Location: ../familySetup#Step1.php");  //REDIRECT
      // header("Location: #Step1.php");  //REDIRECT
    }
  }
 ?>

 <?php
  //IF POST Create transition page.
   if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $html = '<p role="alert" class="status-message">' . echoMsgArray($_SESSION['step1Msgs']) . '</p>';
    $html .= '<p class="Step" hidden>1</p>';
    $html .= '<p><a href="' . WWW_ROOT . '/familySetup.php">Continue with Setup.</a></p>';
    echo $html;
   }else {
  // ELSE redirect to familySetup.php
    echoMsgArray($_SESSION['step1Msgs']);
   }
 ?>

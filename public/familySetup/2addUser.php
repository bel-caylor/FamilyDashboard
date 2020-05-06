<?php require_once('../../private/initialize.php');

$_SESSION['step1Msgs'] = array();
$_SESSION['step2Msgs'] = array();
$_SESSION['step3Msgs'] = array();
$_SESSION['step4Msgs'] = array();
$_SESSION['step5Msgs'] = array();
$_SESSION['step6Msgs'] = array();

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['aryUser'] = array(
        'name' => $_POST['name'],
        'initial' => $_POST['initial'],
        'color' => $_POST['color'],
        'admin' => isset($_POST['admin']) ?? '',
        'email' => $_POST['email'],
        'password1' => $_POST['password1'] ?? $_SESSION['password'],
        'password2' => $_POST['password2'] ?? $_SESSION['password']
      );

  validateUser();

  //Add data to Database & session['Users']
    if (count($_SESSION['step2Msgs']) == 0) {
        $result = sqlAddUser();
        if ($result == 1) {  //UPDATE FAILED
          array_push($_SESSION['step2Msgs'],"Update failed.  Please try again.");
          header("Location: " . WWW_ROOT . "/familySetup.php#Step2");  //REDIRECT

        }else {  //UPDATE PASSED
          //Main user.
          if (count($_SESSION['users']) == 0) {
            $_SESSION['currentName'] = $_SESSION['aryUser']['name'];
            $_SESSION['currentUserID'] = $result;
            $_SESSION['admin'] = $_SESSION['aryUser']['admin'];
          }

          //Reset form fields.
          $_SESSION['aryUser'] = [];
          $_SESSION['step'] = '4';
          header("Location: " . WWW_ROOT . "/familySetup.php#Step3");  //REDIRECT

        }
    }else {
      header("Location: " . WWW_ROOT . "/familySetup.php#Step2");  //REDIRECT
    }
    };

  //IF POST Create transition page.
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $html = '';
    foreach ($_SESSION['step2Msgs'] as $msg) {
      echo "<b>" . $msg . "</b><br>";
    }
     $html .= '<p><a href="' . WWW_ROOT . '/familySetup.php">Continue with Setup.</a></p>';
     echo $html;
    }else {
     // ELSE redirect to familySetup.php
    }

  ?>

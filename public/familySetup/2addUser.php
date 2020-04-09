<?php require_once('../../private/initialize.php');
  $familyID = $_POST['familyID'] ?? $_SESSION['familyID'] ?? '';
  $step = $_GET['step'] ?? $_POST['step'] ?? $_SESSION['step'] ?? '';
  $_SESSION['users'] = $_SESSION['users'] ?? [];
  $_SESSION['step2Msgs'] = [];

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['initial'] = $_POST['initial'];
    $_SESSION['color'] = $_POST['color'];
    $_SESSION['admin'] = isset($_POST['admin']) ?? '';
    $_SESSION['email'] = $_POST['email'];
    // $_SESSION['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // $_SESSION['password2'] = password_hash($_POST['password2'], PASSWORD_DEFAULT);
  }

  validateUser();

  //Add data to Database & session['Users']
    if ($_SESSION['step2Msgs'] == []) {
        $result = sqlAddUser();
        if ($result == 1) {  //UPDATE FAILED
          array_push($_SESSION['step2Msgs'],"Update failed.  Please try again.");
        }else {  //UPDATE PASSED
          //Remove AddUser session VALUES

          //Add User to session['Users']
            $_SESSION['currentUserID'] = $result;
            array_push($_SESSION['step2Msgs'],"User Added");
            $_SESSION['users'][$_SESSION['name']] = array(
              'ID' => $result,
              'Initial' => $_SESSION['initial'],
              'Color' => $_SESSION['color']
              'Admin' => $_SESSION['admin']
              'Email' => $_SESSION['email']
            );
          //Reset form fields.
          $_SESSION['currentUserID'] = $_SESSION['userID']
          $_SESSION['name'] = '';
          $_SESSION['initial'] = '';
          $_SESSION['color'] = '';
          $_SESSION['admin'] = '';
          $_SESSION['userID'] = '';
        }
    } else {

    }

  //IF POST Create transition page.
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $html = '';
    foreach ($_SESSION['step2Msgs'] as $msg) {
      echo $msg . "<br>";
    }
     $html .= '<p><a href="' . WWW_ROOT . '/familySetup.php">Continue with Setup.</a></p>';
     echo $html;
    }else {
     // ELSE redirect to familySetup.php
        // header("Location: " . WWW_ROOT . "/familySetup.php");  //REDIRECT
    }


  ?>

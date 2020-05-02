<?php require_once('../../private/initialize.php');

  $_SESSION['step2Msgs'] = array();
  $errors = array();

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
  // $_SESSION['step2Msgs'] = validateUser();

  // echo count($errors) . '<br>';

  //Add data to Database & session['Users']
    if (count($_SESSION['step2Msgs']) == 0) {
        $result = sqlAddUser();
        if ($result == 1) {  //UPDATE FAILED
          array_push($_SESSION['step2Msgs'],"Update failed.  Please try again.");

        }else {  //UPDATE PASSED

          //Add User to session['Users']
            // $_SESSION['currentUserID'] = $result;
            // array_push($_SESSION['step2Msgs'],"User Added");
            // array_push($_SESSION['users'],
            //   array(
            //   'ID' => $result,
            //   'Name' => $_SESSION['aryUser']['name'],
            //   'Initial' => $_SESSION['aryUser']['initial'],
            //   'Color' => $_SESSION['aryUser']['color'],
            //   'Admin' => $_SESSION['aryUser']['admin'],
            //   'Email' => $_SESSION['aryUser']['email'])
            // );
          //Main user.
          if (count($_SESSION['users']) == 0) {
            $_SESSION['currentName'] = $_SESSION['aryUser']['name'];
            $_SESSION['currentUserID'] = $result;
          }

          //Reset form fields.
          $_SESSION['aryUser'] = [];

        }
    }
    };
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

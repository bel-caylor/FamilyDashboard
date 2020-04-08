<?php require_once('../../private/initialize.php');
  $familyID = $_POST['familyID'] ?? $_SESSION['familyID'] ?? '';
  $step = $_GET['step'] ?? $_POST['step'] ?? $_SESSION['step'] ?? '';
  $users = $_SESSION['users'] ?? [];
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

  //Validate passwords match
    if ($_POST['password'] !== $_POST['password2']) {
      array_push($_SESSION['step2Msgs'],"Passwords DON'T match.");}

  //Validate unique User
    foreach($users as $user) {
      if ($user == $_POST['name']) {
        array_push($_SESSION['step2Msgs'],"Duplicate user name.");}}

  //Validate unique initial
    foreach(array_column($users, 'initial') as $initial) {
      if ($initial == $_POST['initial']) {
        array_push($_SESSION['step2Msgs'],"Duplicate initial.");}}

  //Validate unique color
    foreach(array_column($users, 'color') as $color) {
      if ($color == $_POST['color']) {
        array_push($_SESSION['step2Msgs'],"Duplicate color.");}}

  //Add data to Database & session['Users']
    if ($_SESSION['step2Msgs'] = []) {
        $result = sqlAddUser()
        if ($result == 1) {  //UPDATE FAILED
          array_push($_SESSION['step2Msgs'],"Update failed.  Please try again.");
        }else {  //UPDATE PASSED
          //Remove AddUser session VALUES
            $_SESSION['name'] = '';
            $_SESSION['initial'] = '';
            $_SESSION['color'] = '';
            $_SESSION['admin'] = '';
            $_SESSION['email'] = '';
            // $_SESSION['password'] = '';
            // $_SESSION['password2'] = '';
          //Add User to session['Users']
            $_SESSION['UserID'] = $result;
////////////////NEED TO FIGURE OUT HOW TO PUSH USER TO $_SESSION['users'] array
            $_SESSION['users']["$_SESSION['name']"] = array(
              'id' => 3,
              'initial' => 'J',
              'color' => '$ffffff'
            );
        }
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

<?php require_once('initialize.php'); ?>

  <?php
      // echo 'array_key_exists=' . array_key_exists("Bel",$_SESSION['users']) . '<br>';
      // $newArray = replaceKey($_SESSION['users'], "Bel", "Belinda");
      // printArray($newArray);
      // $_SESSION['users'] = replaceKey($_SESSION['users'], "Bel", "Belinda");
      // $_SESSION['users'] = [];
      // unset($_SESSION['users'][NULL]);
      // json_change_key($_SESSION['users'], $_SESSION['users']['Bel'], $_SESSION['users']['Belinda']);
      // unset( $_SESSION['users']['47']);
      //Step1
      array_push($_SESSION['step2Msgs'], "<br>Passwords don\'t match.");
  ?>
<div> <p>Step 1</p>
<?php
  // printValue('REQUEST_METHOD');
  printValue('step');
  printValue('familyID');
  printValue('family');
  printValue('postalCode');
  printValue('step1Msgs');

?>
</div>

<div> <p>Step 2</p>
  <?php
  // echo count($_SESSION['step2Msgs']);
  printValue('aryUser');
  printValue('step2Msgs');
  printValue('currentUserID');
  printValue('currentName');
  printValue('password');
  printValue('step3Msgs');
  printValue('input');
  printValue('users');

  ?>
</div>

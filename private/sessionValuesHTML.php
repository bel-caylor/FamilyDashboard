<?php require_once('initialize.php'); ?>

<div class="section inline">
  <button onclick="clickExpandBtn('Sessions')">
    <h2 class="inline">&#9660; $_SESSION</h2>
  </button>
</div>

<div id="Sessions" class="form hidden">

  <?php
      //Step1
      echo 'request_method=' . $_SERVER['REQUEST_METHOD'] . '<br>';
      echo 'step=' . $_SESSION['step'] . '<br>';
      echo 'familyID=' . $_SESSION['familyID'] . '<br>';
      echo 'family=' . $_SESSION['family'] . '<br>';
      echo 'postalCode=' . $_SESSION['postalCode'] . '<br>';
      // echo 'step1Msgs=' . $_SESSION['step1Msgs'] . '<br>';
      echo 'step1Msgs=<br>' . echoMsgArray($_SESSION['step1Msgs']);
      //Step2
      echo 'name=' . $_SESSION['name'] . '<br>';
      echo 'initial=' . $_SESSION['initial'] . '<br>';
      echo 'color=' . $_SESSION['color'] . '<br>';
      echo 'admin=' . $_SESSION['admin'] . '<br>';
      echo 'email=' . $_SESSION['email'] . '<br>';
      echo 'userID=' . $_SESSION['userID'] . '<br>';
      echo 'currentUserID=' . $_SESSION['currentUserID'] . '<br>';
      echo 'currentName=' . $_SESSION['currentName'] . '<br>';
      echo 'step2Msgs=<br>' . echoMsgArray($_SESSION['step2Msgs']);
      echo 'currentUserID=' . $_SESSION['currentUserID'] . '<br>';
      echo 'password=' . $_SESSION['password'] . '<br>';
      echo 'users=<br>';
      printArray($_SESSION['users']);

  ?>
</div>

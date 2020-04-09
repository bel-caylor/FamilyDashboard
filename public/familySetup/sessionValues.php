<?php
require_once('../private/initialize.php');
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
  $_SESSION['currentUserID'] = $_SESSION['userID'] ?? '';
  $_SESSION['step2Msgs'] = $_SESSION['step2Msgs'] ?? [];
  $_SESSION['users'] = $_SESSION['users'] ?? [];
?>
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
      echo 'step2Msgs=<br>' . echoMsgArray($_SESSION['step2Msgs']);

 ?>
    </div>

<?php



 ?>

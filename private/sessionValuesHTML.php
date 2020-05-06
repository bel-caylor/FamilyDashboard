<?php require_once('initialize.php'); ?>
<?php require_once('./shared/optionsFreq.php');

  // echo $tasks;
  // print_r($tasks);
  // echo date(DATE_ATOM) . "<br>";
  // // $date = date("Y-m-d H:i:s.Z");
  // $date = date(DATE_ATOM, "2020-04-21");
  // echo $date;
  printValue('sql');


  // echo ;
      // echo 'array_key_exists=' . array_key_exists("Bel",$_SESSION['users']) . '<br>';
      // $newArray = replaceKey($_SESSION['users'], "Bel", "Belinda");
      // printArray($newArray);
      // $_SESSION['users'] = replaceKey($_SESSION['users'], "Bel", "Belinda");
      // $_SESSION['admin'] = 1;

      // $_SESSION['step'] = 4;
      // jshange_key($_SESSION['users'], $_SESSION['users']['Bel'], $_SESSION['users']['Belinda']);
      // unset( $_SESSION['users']['1']);
      //Step1
      // array_push($_SESSION['step2Msgs'], "<br>Passwords don\'t match.");
// sqlCatNames($familyID);
include(PRIVATE_PATH . '/shared/optionsCatName.php');
  ?>
<div> <p>Step 1</p>
<?php
  echo $_POST['REQUEST_METHOD'];
  printValue('step');
  printValue('familyID');
  printValue('family');
  printValue('postalCode');
  printValue('step1Msgs');

?>
</div>

<div> <p>Step 2</p>
  <?php
  echo count($_SESSION['step2Msgs']) . "<br>";
  printValue('email');
  printValue('aryUser');
  printValue('step2Msgs');
  echo echoMsgArray($_SESSION['step2Msgs']);
  printValue('currentUserID');
  printValue('currentName');
  printValue('admin');
  printValue('password');
  printValue('step3Msgs');
  printValue('input');
  printValue('users');

  ?>
</div>

<div> <p>Step 4</p>
  <?php
    // $tasks = sqlTasks($_SESSION['familyID']);
    // print_r(mysqli_fetch_assoc($tasks));
    // echo '<br>';
    // foreach (mysqli_fetch_assoc($tasks) as $task) {
    //   echo $task;
    // }
    // printValue('aryUser');

    // $freq = sqlSelect("frequency", "ID");
    // while($row = mysqli_fetch_assoc($freq)) {
    //   // array_push($_SESSION['freq'], $row);
    //   $_SESSION['freq'][$row['ID']] = $row;
    // }

    // printValue('freq');
    // optionFreq(2);

  ?>
</div>

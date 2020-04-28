<?php require_once('../../private/initialize.php');
  $_SESSION['step2Msgs'] = array();
  $_SESSION['step3Msgs'] = array();
  $_SESSION['step4Msgs'] = array();

  //Add Room name to category-names.

  //Check for duplicate Category Name.

  $catNameID = sqlAddCategory($_POST['category'], $_POST['catName'], 1);
  // echo $catNameID . "<br>";
  if ($catNameID == "insert failed") {
    echo 'insert failed';
  } else {
    // echo '<br>' . $catNameID;

    //Add Default Tasks to tasks.
    sqlAddDefaultTasks($_POST['category'], $catNameID);
    $_SESSION['step'] = '5';
  }


  header("Location: " . WWW_ROOT . "/familySetup.php");  //REDIRECT


?>

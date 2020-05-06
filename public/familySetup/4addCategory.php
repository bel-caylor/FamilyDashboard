<?php require_once('../../private/initialize.php');

$_SESSION['step1Msgs'] = array();
$_SESSION['step2Msgs'] = array();
$_SESSION['step3Msgs'] = array();
$_SESSION['step4Msgs'] = array();
$_SESSION['step5Msgs'] = array();
$_SESSION['step6Msgs'] = array();

  //Check for duplicate Category Name.
  $catNameID = sqlAddCategory($_POST['category'], $_POST['catName'], 1);
  // echo $catNameID . "<br>";

  if ($catNameID == "insert failed") {
    array_push($_SESSION['step4Msgs'],"Insert failed.  Please try again.");
    header("Location: " . WWW_ROOT . "/familySetup.php#Step4");  //REDIRECT
  } else {
    // echo '<br>' . $catNameID;

    //Add Default Tasks to tasks.
    sqlAddDefaultTasks($_POST['category'], $catNameID);
    $_SESSION['step'] = '5';
    header("Location: " . WWW_ROOT . "/familySetup.php#Step4");  //REDIRECT
  }




?>

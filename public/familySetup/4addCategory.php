<?php require_once('../../private/initialize.php');
  $_SESSION['step2Msgs'] = array();
  $_SESSION['step3Msgs'] = array();
  $_SESSION['step4Msgs'] = array();

  //Add Room name to category-names.
  sqlAddCategory($_POST['category'], $_POST['catName']);

  //Add Default Tasks to tasks.
  sqlAddDefaultTasks($_POST['category']);
  $_SESSION['step'] = '4';

  header("Location: " . WWW_ROOT . "/familySetup.php");  //REDIRECT


?>

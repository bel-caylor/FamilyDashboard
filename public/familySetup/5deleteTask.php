<?php require_once('../../private/initialize.php');
  if ($_SESSION['currentUserID'] === '') {
    header("Location: " . WWW_ROOT . "/login.php");
  }
  $taskID = $_GET['taskID'];
  $result = sqlDeleteTask($taskID);
  $_SESSION['step2Msgs'] = array();
  $_SESSION['step3Msgs'] = array();
  $_SESSION['step4Msgs'] = array();

  if ($result[0] !== "delete failed") {
    //Edit complete.
    echo "Delete Succeeded.";
  }else {
    //Edit failed.
    echo "Delete Failed. Please try again later.";
  }

?>

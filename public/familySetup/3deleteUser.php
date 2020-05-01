<?php require_once('../../private/initialize.php');
  // Check for login
  if ($_SESSION['currentUserID'] === '') {
    header("Location: " . WWW_ROOT . "/login.php");
  }
  $ID = $_GET['id'];
  $row = $_GET['row'];
  $result = sqlDeleteUser($ID);
  $_SESSION['step2Msgs'] = array();
  $_SESSION['step3Msgs'] = array();

  if ($result[0] !== "delete failed") {
    //Edit complete.
    echo "Delete Succeeded.";
    //Remove user from session users
    unset( $_SESSION['users'][$row]);
  }else {
    //Edit failed.
    echo "Delete Failed. Please try again later.";
  }

?>

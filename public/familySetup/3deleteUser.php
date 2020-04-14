<?php require_once('../../private/initialize.php');
  $ID = $_GET['id'];
  $result = sqlDeleteUser($ID);

  if ($result[0] !== "delete failed") {
    //Edit complete.
    echo "Delete Succeeded.";
    unset( $_SESSION['users']['$ID']);
  }else {
    //Edit failed.
    echo "Delete Failed. Please try again later.";
  }

?>

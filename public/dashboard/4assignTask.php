<?php require_once('../../private/initialize.php');
  $input = get_object_vars(json_decode(file_get_contents('php://input')));

  //Set variables.
  $_SESSION['input'] = $input;

  // if ($_SESSION['step3Msgs'] == []) {
    $result = sqlAssignTask($input);
    // printArray($result);
    if ($result[0] !== "edit failed") {
      //Edit complete.
      echo "Update Succeeded.";
    }else {
      //Edit failed.
      echo "Update Failed. Please try again later.";
    }

?>

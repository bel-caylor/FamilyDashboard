<?php require_once('../../private/initialize.php');

  $input = get_object_vars(json_decode(file_get_contents('php://input')));
  $_SESSION['step1Msgs'] = array();
  $_SESSION['step2Msgs'] = array();
  $_SESSION['step3Msgs'] = array();
  $_SESSION['step4Msgs'] = array();
  $_SESSION['step5Msgs'] = array();
  $_SESSION['step6Msgs'] = array();

  //Set variables.
  $_SESSION['input'] = $input;

  // if ($_SESSION['step3Msgs'] == []) {
    $result = sqlEditCat($input);
    // printArray($result);
    if ($result[0] !== "edit failed") {
      //Edit complete.
      echo "Update Succeeded.";
    }else {
      //Edit failed.
      echo "Update Failed. Please try again later.";
    }

?>

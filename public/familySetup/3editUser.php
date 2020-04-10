<?php require_once('../../private/initialize.php');
  $input = json_decode(file_get_contents('php://input'));

  //Set variables.
  $_SESSION['input'] = $input;
  $_SESSION['name'] = $input->name ?? $_POST['name'];
  $_SESSION['initial'] = $input->initial ?? $_POST['initial'];
  $_SESSION['color'] = $input->color ?? $_POST['color'];
  $_SESSION['admin'] = $input->admin ?? isset($_POST['admin']) ?? '';
  $_SESSION['email'] = $input->email ?? $_POST['email'];
  $_SESSION['userID'] = $input->userID ?? $_POST['userID'];

  //Need to fix
  // $_SESSION['step3Msgs'] = validateUser();

  // if ($_SESSION['step3Msgs'] == []) {
    $result = sqlEditUser();

    if ($result !== "edit failed") {
      //Edit complete.
      echo "Update Succeeded.";
    }else {
      //Edit failed.
      echo "Update Failed. Please try again later.";
    }

    //Failed Validation
  // } else {

  // }


?>

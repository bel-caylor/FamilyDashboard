<?php require_once('../../private/initialize.php');
  $input = get_object_vars(json_decode(file_get_contents('php://input')));
  $_SESSION['step2Msgs'] = array();
  $_SESSION['step3Msgs'] = array();

  //Set variables.
  $_SESSION['input'] = $input;
  $userID = $input['userID'] ?? $_POST['userID'];
  // echo $userID;
  $_SESSION['aryUser'] = array(
      'id' => $userID,
      'name' => $input['name'],
      'initial' => $input['initial'],
      'color' => $input['color'],
      'admin' => isset($input['admin']) ?? '',
      'email' => $input['email']
    );

  //Need to fix
  // $_SESSION['step3Msgs'] = validateUser();

  // if ($_SESSION['step3Msgs'] == []) {
    $result = sqlEditUser();
    // printArray($result);
    if ($result[0] !== "edit failed") {
      //Edit complete.
      echo "Update Succeeded.";
      updateUsersArray($userID);
    }else {
      //Edit failed.
      echo "Update Failed. Please try again later.";
    }

    //Failed Validation
  // } else {

  // }

function updateUsersArray($userID) {
  foreach ($_SESSION['users'] as $user) {
    if ($user[ID] == $_SESSION['aryUser']['id']) {
      $user['Name'] = $_SESSION['aryUser']['name'];
      $user['Initial'] = $_SESSION['aryUser']['initial'];
      $user['Color'] = $_SESSION['aryUser']['color'];
      $user['Admin'] = $_SESSION['aryUser']['admin'];
      $user['Email'] = $_SESSION['aryUser']['email'];
      break;
    }
  }

$_SESSION['aryUser'] = [];
}

?>

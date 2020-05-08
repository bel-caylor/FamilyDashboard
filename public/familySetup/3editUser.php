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
      'admin' => $input['admin'],
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
    // echo $user['ID'] . "-" . $_SESSION['aryUser']['id'];
    if ($user['ID'] == $_SESSION['aryUser']['id']) {
      $_SESSION['users'][$user['ID']]['Name'] = $_SESSION['aryUser']['name'];
      $_SESSION['users'][$user['ID']]['Initial'] = $_SESSION['aryUser']['initial'];
      $_SESSION['users'][$user['ID']]['Color'] = $_SESSION['aryUser']['color'];
      $_SESSION['users'][$user['ID']]['Admin'] = $_SESSION['aryUser']['admin'];
      $_SESSION['users'][$user['ID']]['Email'] = $_SESSION['aryUser']['email'];
      break;
    }
  }

$_SESSION['aryUser'] = [];
}

?>

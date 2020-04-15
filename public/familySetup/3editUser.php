<?php require_once('../../private/initialize.php');
  $input = get_object_vars(json_decode(file_get_contents('php://input')));

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
  $_SESSION['users'][$userID]['Name'] = $_SESSION['aryUser']['name'];
  $_SESSION['users'][$userID]['Initial'] = $_SESSION['aryUser']['initial'];
  $_SESSION['users'][$userID]['Color'] = $_SESSION['aryUser']['color'];
  $_SESSION['users'][$userID]['Admin'] = $_SESSION['aryUser']['admin'];
  $_SESSION['users'][$userID]['Email'] = $_SESSION['aryUser']['email'];

$_SESSION['aryUser'] = [];
}

?>

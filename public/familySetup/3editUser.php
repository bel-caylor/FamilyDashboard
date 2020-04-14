<?php require_once('../../private/initialize.php');
  $input = get_object_vars(json_decode(file_get_contents('php://input')));

  //Set variables.
  $_SESSION['input'] = $input;
  $userID = $input['userID'] ?? $_POST['userID'];
  // echo $userID;
  $_SESSION['name'] = $input['name'];
  $_SESSION['initial'] = $input['initial'];
  $_SESSION['color'] = $input['color'];
  $_SESSION['email'] = $input['email'];
  $_SESSION['userID'] = $input['userID'];

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
  $_SESSION['users'][$userID]['Name'] = $_SESSION['name'];
  $_SESSION['users'][$userID]['Initial'] = $_SESSION['initial'];
  $_SESSION['users'][$userID]['Color'] = $_SESSION['color'];
  $_SESSION['users'][$userID]['Admin'] = $_SESSION['admin'];
  $_SESSION['users'][$userID]['Email'] = $_SESSION['email'];

  $_SESSION['name'] = '';
  $_SESSION['initial'] = '';
  $_SESSION['color'] = '';
  $_SESSION['email'] = '';
  $_SESSION['userID'] = '';
}

?>

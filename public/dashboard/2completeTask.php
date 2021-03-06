<?php require_once('../../private/initialize.php');
  // Check for login
  if ($_SESSION['currentUserID'] === '') {
    header("Location: " . WWW_ROOT . "/login.php");
  }
  $input = get_object_vars(json_decode(file_get_contents('php://input')));

//Add task to task_log table.
  $input = array (
    'taskID' => $input['taskID'] ?? $_POST['taskID'],
    'userID' => $_SESSION['currentUserID'],
    'time' => $input['time'] ?? $_POST['time'],
    'tzOffset' => $input['tzOffset'] ?? 0
  );
  $taskLogID = sqlAddCompleteTask($input);

  //CHECK FOR SUCCESS
  if ($taskLogID !== "insert failed") {
  // Edit Start on tasks table to reflect next time for the task.
    $result = sqlUpdateNextStart($input);
    echo "<div id=newStart>" . $result . "</div>";
  }
  echo "<div id=taskLogID>" . $taskLogID . "</div>";

?>

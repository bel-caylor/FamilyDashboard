<?php require_once('../../private/initialize.php');
  // Check for login
  if ($_SESSION['currentUserID'] === '') {
    header("Location: " . WWW_ROOT . "/login.php");
  }
  $input = get_object_vars(json_decode(file_get_contents('php://input')));

//Add task to task_log table.
  $result = sqlSaveRedoTask($input['taskLogID']);

  echo "<div id=completeTaskStatus>" . $result . "</div>";

?>

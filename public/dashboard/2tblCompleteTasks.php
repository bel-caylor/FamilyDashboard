<?php require_once('../private/shared/optionUsers.php'); ?>
<?php require_once('../private/shared/optionsFreq.php'); ?>
<?php

$date = date_create();
$date = date_format($date,"Y-m-d H:i:s");


  //Import Categories
    $categories = sqlCategories($_SESSION['familyID']);
  //Import type.

 ?>
<div id="status"></div>
<table id="tblTasks" class="table">

  <!-- Heading Row -->
    <tr>
      <th class="tooltip"><span class="tooltiptext">Done</span>Chk</th>
      <th class="tooltip"><span class="tooltiptext">Minutes to<br>Complete</span>Time</th>
      <th class="task">Task</th>
    </tr>

  <!-- Assigned Tasks -->

    <?php
      $tasks = sqlAssignedTasks($_SESSION['currentUserID'], $date);
      if ($tasks->num_rows > 0) {
    ?>
        <tr>
          <th colspan="3" class="category">Assigned Tasks</th>
        </tr>

    <?php
      }
      while($row = mysqli_fetch_assoc($tasks)) {
          createTableRow($row);}
    ?>

<!-- House Tasks -->
    <tr>
      <th colspan="4" class="category">House Tasks</th>
    </tr>
  <?php
      $tasks = sqlHouseTasks($_SESSION['familyID'], $date);
        while($row = mysqli_fetch_assoc($tasks)) {
          createTableRow($row);}
          ?>

  <!-- Personal Tasks -->
    <tr>
      <th colspan="4" class="category">Personal Tasks</th>
    </tr>
  <?php
      $tasks = sqlPersonalTasks($_SESSION['currentUserID'], $date);
        while($row = mysqli_fetch_assoc($tasks)) {
          createTableRow($row);}
  ?>

</table>



<!-- Create Table Function -->
<?php function createTableRow($row) {
    $task = $row['Description'] . "-" . $row['Task'];
     if ($row['Name'] !== "Main") {
       $task .= "-" . $row['Name'];
     }
  ?>
  <tr id="task<?php echo $row['taskID'] ?>">
    <!-- Checkbox -->
      <th><input type="checkbox" onchange="toggleCompleteTask(<?php echo $row['taskID'] ?>)"></th>
      <!-- <th><input type="checkbox" onchange="/dashboard/2completeTask.php?taskID=<?php echo $row['taskID'] ?>&time=<?php echo $row['Time'] ?>"></th> -->
    <!-- Time Spent -->
      <th><input type="text" id="time<?php echo $row['taskID'] ?>" value="<?php echo $row['Time'] ?>" size="1" onchange="changeTaskTime(<?php echo $row['taskID'] ?>)"></th>
    <!-- Task -->
      <th class="task"><input type="text" size="45" value="<?php echo $task?>"></th>
  </tr>
<?php } ?>

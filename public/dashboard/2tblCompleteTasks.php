<?php
  // Check for login
  if ($_SESSION['currentUserID'] === '') {
    header("Location: " . WWW_ROOT . "/login.php");
  }
$date = date_create();
$date = date_format($date,"Y-m-d H:i:s");
$taskTbl = '';


  //Import Categories
    $categories = sqlCategories($_SESSION['familyID']);
  //Import type.

 ?>
<div id="contentStep2" class="">
 <div id="assigedChart">
   <?php include(PUBLIC_PATH . '/dashboard/2sumComplete.php') ?>
 </div>
    <div id="status"></div>
    <table id="tblTasks" class="table">

      <!-- Heading Row -->
        <tr>
          <th class="tooltip"><span class="tooltiptext">Done</span>Chk</th>
          <th class="tooltip"><span class="tooltiptext">Minutes to<br>Complete</span>Time</th>
          <th class="task">Task</th>
        </tr>

      <!-- REDO Tasks -->
        <?php
          $tasks = sqlRedoTask($_SESSION['currentUserID']);
          if ($tasks->num_rows > 0) { $taskTbl = 1;
        ?>
            <tr>
              <th colspan="3" class="category">REDO Tasks</th>
            </tr>

        <?php
          }
          while($row = mysqli_fetch_assoc($tasks)) {
              createRedoTableRow($row);}
        ?>

      <!-- Assigned Tasks -->

        <?php
          $tasks = sqlAssignedTasks($_SESSION['currentUserID'], $date);
          if ($tasks->num_rows > 0) { $taskTbl = 1;
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
      <?php
        $tasks = sqlHouseTasks($_SESSION['familyID'], $date);
        if ($tasks->num_rows > 0) { $taskTbl = 1;
        ?>
          <tr>
            <th colspan="3" class="category">House Tasks</th>
          </tr>
          <?php
              while($row = mysqli_fetch_assoc($tasks)) {
                createTableRow($row);}
        }?>

      <!-- Personal Tasks -->
      <?php
      $tasks = sqlPersonalTasks($_SESSION['currentUserID'], $date);
        if ($tasks->num_rows > 0) { $taskTbl = 1;
        ?>
        <tr>
          <th colspan="3" class="category">Personal Tasks</th>
        </tr>
        <?php
            while($row = mysqli_fetch_assoc($tasks)) {
              createTableRow($row);}
        }

        if ($taskTbl != 1) {echo "<p class=center>No tasks to display.</p>";}
        ?>

    </table>
</div>

<!-- Create REDO Table Function -->
<?php function createRedoTableRow($row) {
    $task = $row['Description'] . "-" . $row['Task'];

  ?>
    <tr id="task<?php echo $row['taskLogID'] ?>">
      <!-- Checkbox -->
        <th><input type="checkbox" onchange="toggleRedoTask(<?php echo $row['taskLogID'] ?>)"></th>
      <!-- Grade -->
        <th class="tblInput"><?php echo $row['Grade']?>%</th>
      <!-- Task -->
        <th class="tblText"><?php echo $task?></th>
    </tr>
    <!-- Add Note if not BLANK -->
      <?php if($row['Note'] != "") {?>
        <tr>
          <th colspan="2" class="formLabel">Note:</th>
          <th class="tblAlert"><?php echo $row['Note'] ?></th>
        </tr>
      <?php } ?>

<?php } ?>


<!-- Create Table Function -->
<?php function createTableRow($row) {
    $task = $row['Description'] . "-" . $row['Task'];

  ?>
    <tr id="task<?php echo $row['taskID'] ?>">
      <!-- Checkbox -->
        <th><input type="checkbox" onchange="toggleCompleteTask(<?php echo $row['taskID'] ?>)"></th>
      <!-- Time Spent -->
        <th class="tblInput"><input type="text" id="time<?php echo $row['taskID'] ?>" value="<?php echo $row['Time'] ?>" size="1" onchange="changeTaskTime(<?php echo $row['taskID'] ?>)"></th>
      <!-- Task -->
        <th class="tblText"><?php echo $task?></th>
    </tr>
    <!-- Add Note if not BLANK -->
      <?php if($row['Note'] != "") {?>
        <tr>
          <th colspan="2" class="formLabel">Note:</th>
          <th class="tblAlert"><?php echo $row['Note'] ?></th>
        </tr>
      <?php } ?>

<?php } ?>

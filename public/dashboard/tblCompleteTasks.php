<?php require_once('../private/shared/optionUsers.php'); ?>
<?php require_once('../private/shared/optionsFreq.php'); ?>
<?php

  //Import Categories
    $categories = sqlCategories($_SESSION['familyID']);
  //Import type.

 ?>

<table id="tblTasks" class="table">

  <!-- Heading Row -->
    <tr>
      <th class="tooltip"><span class="tooltiptext">Done</span>Chk</th>
      <th class="tooltip"><span class="tooltiptext">Minutes to<br>Complete</span>Time</th>
      <th>Task</th>
    </tr>

  <!-- Assigned Tasks -->
    <tr>
      <th colspan="3" class="category">Assigned Tasks</th>
    </tr>
    <?php
      $tasks = sqlAssignedTasks($_SESSION['currentUserID']);
        while($row = mysqli_fetch_assoc($tasks)) {
          createTableRow($row);}
    ?>

<!-- House Tasks -->
    <tr>
      <th colspan="4" class="category">House Tasks</th>
    </tr>
  <?php
      $tasks = sqlHouseTasks($_SESSION['familyID']);
        while($row = mysqli_fetch_assoc($tasks)) {
          createTableRow($row);}
          ?>

  <!-- Personal Tasks -->
    <tr>
      <th colspan="4" class="category">Personal Tasks</th>
    </tr>
  <?php
      $tasks = sqlPersonalTasks($_SESSION['currentUserID']);
        while($row = mysqli_fetch_assoc($tasks)) {
          createTableRow($row);}
  ?>

</table>



<!-- Create Table Function -->
<?php function createTableRow($data) {
    $task = $data['Description'] . "-" . $data['Task'];
     if ($data['Name'] !== "Main") {
       $task .= "-" . $data['Name'];
     }
  ?>
  <tr id="task<?php echo $data['ID'] ?>">
    <!-- Checkbox -->
      <th><input type="checkbox" name="chk<?php echo $data['ID'] ?>"></th>
    <!-- Time Spent -->
      <th><input type="text" name="time<?php echo $data['ID'] ?>" value="<?php echo $data['Time'] ?>" size="1"></th>
    <!-- Task -->
      <th class="task"><input type="text" size="25" value="<?php echo $task?>"></th>
  </tr>
<?php } ?>

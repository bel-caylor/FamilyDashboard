<?php require_once('../private/shared/optionUsers.php'); ?>
<?php
  //Import tasks
    $tasks = sqlTasks($_SESSION['familyID']);
  //Import Categories
    $categories = sqlCategories($_SESSION['familyID']);
 ?>

<!-- Delete Task Alert -->
<?php include(SHARED_PATH . '/alertPopUp.php') ?>

<table id="tblTasks" class="table"<?php if ($_SESSION['step'] > 3) {echo " hidden";}?>>
  <!-- Column Names-->
    <!-- <tr>
      <th colspan="6" class="category">Category Name</th>
    </tr>
    <tr>
      <th colspan="3">Task</th>
      <th colspan="1">Assigned</th>
      <th colspan="1" id="EditSave" class="tooltip"><span class="tooltiptext">Edit Task</span>Edt</th>
      <th colspan="1" class="tooltip"><span class="tooltiptext">Delete Task</span>Dlt</th>
    </tr>
    <tr>
      <th class="tooltip" colspan="2"><span class="tooltiptext">Frequency</span>Freq</th>
      <th class="tooltip" colspan="2"><span class="tooltiptext">Start Date</span>Start</th>
      <th class="tooltip" colspan="2"><span class="tooltiptext">Estimated Time to Complete</span>Time</th>
    </tr>
    <tr>
      <th class="note tooltip" colspan="6">Task Notes</th>
    </tr> -->
  <?php $Users = $_SESSION['users'];?>
  <!-- Category Rows -->
      <?php while($category = mysqli_fetch_assoc($categories)) { ?>
          <!-- Category Row -->
            <tr id="cat<?php echo $category['Cat_Name_ID'] ?>" class="tblRow">
              <th  colspan="6" class="category"><?php echo $category['Description'] . "-" . $category['Name']?></th>
            </tr>

          <?php while($task = mysqli_fetch_assoc($tasks)) { ?>
              <!-- Task Row -->
                <tr id="task<?php echo $task['Task_ID'] ?>">
                <!-- Assigned -->
                  <th colspan="1" class="assigned"><?php echo optionUsers($task['User_ID']); ?></th>
                <!-- Task -->
                  <th colspan="3" class="task"><input type="text" size="15" class="task trans" value="<?php echo $task['Task'] ?>" disabled></th>
                <!-- Edit -->
                  <th id="Edt<?php echo $task['Task_ID'] ?>"><button type="button" onclick="editUser(<?php echo $task['Task_ID'] ?>)">&#128393;</button></th>
                <!-- Delete -->
                  <th><button type="button" onclick="clickDeleteTask(<?php echo $task['Task_ID'] ?>')">&#128465;</button></th>
                </tr>
              <!-- Frequency Row -->
                <tr id="freq"<?php echo $task['Task_ID'] ?> class="hidden">
                <!-- Freq -->
                  <th colspan="1"><?php include(PRIVATE_PATH . '/shared/optionsFreq.php') ?></th>
                <!-- Start -->
                  <th colspan="1"><input type="text" size="4" class="name trans" value="<?php echo $task['Start'] ?>" disabled></th>
                <!-- Time -->
                  <th colspan="1"><input type="text" size="4" class="name trans" value="<?php echo $task['Time'] ?>" disabled></th>
                </tr>
              <!-- Note Row -->
                <tr id="Note<?php echo $task['Task_ID'] ?>" class="hidden">
                  <th colspan="6" class="email"><input type="text" size="15" class="trans" value="<?php echo $task['Note'] ?>"></th>
                </tr>
          <?php } ?>

    <?php } ?>
  <!-- </div> -->
</table>

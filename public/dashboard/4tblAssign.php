<?php require_once('../private/shared/optionUsers.php'); ?>
<?php require_once('../private/shared/optionsFreq.php'); ?>
<?php
  //Frequency query
    $freq = sqlSelect("frequency", "ID");
    while($row = mysqli_fetch_assoc($freq)) {
      $_SESSION['freq'][$row['ID']] = $row;
    }

  //Import Categories
    $categories = sqlCategories($_SESSION['familyID']);
  //Import type.
    $type = sqlSelect('type', 'ASC');
 ?>

<!-- Delete Task Alert -->
<?php include(SHARED_PATH . '/alertPopUp.php') ?>

<table id="tblTasks" class="table"<?php if ($_SESSION['step'] > 4) {echo " hidden";}?>>

  <?php $Users = $_SESSION['users'];?>
  <!-- Category Rows -->
      <?php while($category = mysqli_fetch_assoc($categories)) { ?>

        <!-- //Import tasks -->
          <?php  $tasks = sqlTasks($_SESSION['familyID'], $category['Cat_Name_ID']);
            //If $tasks returns rows.
            if ($tasks->num_rows > 0) {?>
            <!-- Category Row -->
              <tr id="cat<?php echo $category['Cat_Name_ID'] ?>" class="tblRow">
                <th  colspan="6" class="category"><?php echo $category['Type'] . "-" . $category['Description'] . "-" . $category['Name']?></th>
              </tr>
          <?php } ?>

            <?php while($task = mysqli_fetch_assoc($tasks)) { ?>
                <!-- Task Row -->
                  <tr id="task<?php echo $task['Task_ID'] ?>">
                  <!-- Assigned -->
                    <th colspan="1" class="assigned" onchange="assignTask(<?php echo $task['Task_ID'] ?>)"><?php echo optionUsers($task['User_ID'], $task['Task_ID']); ?></th>
                  <!-- Task -->
                    <th colspan="3" class="task"><input type="text" size="15" class="task trans" value="<?php echo $task['Task'] ?>" disabled></th>
                  </tr>
            <?php } ?>

      <?php } ?>
  <!-- </div> -->
</table>

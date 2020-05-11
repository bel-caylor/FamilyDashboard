<?php require_once('../private/shared/optionUsers.php'); ?>
<?php require_once('../private/shared/optionsFreq.php'); ?>
<?php
  // Check for login
  if ($_SESSION['currentUserID'] === '') {
    header("Location: " . WWW_ROOT . "/login.php");
  }
  //Frequency query
    $freq = sqlSelect("frequency", "ID");
    while($row = mysqli_fetch_assoc($freq)) {
      $_SESSION['freq'][$row['ID']] = $row;
    }

  //Import Categories
    $categories = sqlCategories($_SESSION['familyID'], 1);

 ?>



<div id="contentStep4" class="hidden">
  <div id="assigedChart">
    <?php include(PUBLIC_PATH . '/familySetup/5sumAssign.php') ?>
  </div>

  <!-- Delete Task Alert -->
  <?php include(SHARED_PATH . '/alertPopUp.php') ?>

  <table id="tblTasks" class="table">

    <?php $Users = $_SESSION['users'];?>
    <!-- Category Rows -->
        <?php while($category = mysqli_fetch_assoc($categories)) { ?>

          <!-- //Import tasks -->
            <?php  $tasks = sqlTasks($_SESSION['familyID'], $category['Cat_Name_ID']);
              //If $tasks returns rows.
              if ($tasks->num_rows > 0) {?>
              <!-- Category Row -->
                <tr id="cat<?php echo $category['Cat_Name_ID'] ?>" class="tblRow">
                  <th  colspan="6" class="category"><?php echo $category['Name']?></th>
                </tr>
            <?php } ?>

              <?php while($task = mysqli_fetch_assoc($tasks)) { ?>
                  <!-- Task Row -->
                    <tr id="task<?php echo $task['Task_ID'] ?>">
                    <!-- Assigned -->
                      <th colspan="1" class="assigned" onchange="assignTask(<?php echo $task['Task_ID'] ?>)"><?php echo optionUsers($task['User_ID'], $task['Task_ID'], "assignTask"); ?></th>
                    <!-- Task -->
                      <th colspan="3" class="task"><input type="text" size="15" class="task trans" value="<?php echo $task['Task'] ?>" disabled></th>
                    </tr>
              <?php } ?>

        <?php } ?>
    <!-- </div> -->
  </table>
</div>

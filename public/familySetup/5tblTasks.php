<?php

  //Import Categories
    $categories = sqlCategories($_SESSION['familyID']);
    if (mysqli_num_rows($categories) > 0) {
      $_SESSION['step'] = 5;
    }
  //Import type.
    $type = sqlSelect('type', 'ASC');

  //Are there tasks to display?
  $tasks = sqlCategories($_SESSION['familyID']);
  if ($tasks->num_rows > 0) {
 ?>

 <div id="contentStep5" >
   <div id="assigedChart">
     <?php include(PUBLIC_PATH . '/familySetup/5sumAssign.php') ?>
   </div>
   <p role="alert" id="step5Msgs" class="status-message"><?php if ($_SESSION['step5Msgs'] !== []) {echo echoMsgArray($_SESSION['step5Msgs']);} ?></p>
   <!-- Delete Task Alert -->
   <?php include(SHARED_PATH . '/alertPopUp.php') ?>

   <table id="tblTasks" class="table"<?php if ($_SESSION['step'] < 5) {echo " hidden";}?>>

     <?php $Users = $_SESSION['users'];?>
     <!-- Category Rows -->
         <?php while($category = mysqli_fetch_assoc($categories)) { ?>

           <!-- //Import tasks -->
             <?php  $tasks = sqlTasks($_SESSION['familyID'], $category['Cat_Name_ID']);
               //If $tasks returns rows.
               if ($tasks->num_rows > 0) {?>
               <!-- Category Row -->
                 <tr id="cat<?php echo $category['Cat_Name_ID'] ?>" class="tblRow">
                   <th  colspan="6" class="category"><?php echo $category['Type'] . "-" . $category['Name']?></th>
                 </tr>
             <?php } ?>

               <?php while($task = mysqli_fetch_assoc($tasks)) { ?>
                   <!-- Task Row -->
                     <tr id="task<?php echo $task['Task_ID'] ?>">
                     <!-- Assigned -->
                       <th colspan="1" class="assigned"><?php echo optionUsers($task['User_ID'], $task['Task_ID'], "saveTask"); ?></th>
                     <!-- Task -->
                       <th colspan="3" class="task"><input type="text" size="15" class="task trans" value="<?php echo $task['Task'] ?>" disabled></th>
                     <!-- Edit -->
                       <th id="EdtTask<?php echo $task['Task_ID'] ?>" class="tooltip"><span class="tooltiptext">Edit Task</span><button type="button" onclick="editTask(<?php echo $task['Task_ID'] ?>)"><i class="fas fa-pencil-alt"></i></th>
                     <!-- Delete -->
                       <th id="DelTask<?php echo $task['Task_ID'] ?>" class="tooltip"><span class="tooltiptext">Delete<br>Task</span><button type="button" onclick="deleteTask(<?php echo $task['Task_ID'] ?>)"><i class="far fa-trash-alt"></i></th>
                     </tr>
                   <!-- Frequency Row -->
                     <tr id="freqRow<?php echo $task['Task_ID'] ?>" class="hidden">
                     <!-- Freq -->
                       <th colspan="1" class="assigned tooltip"><span class="tooltiptext">Frequency</span><?php echo optionFreq($task['Freq_ID'], $task['Task_ID']); ?></th>
                     <!-- Next Time to Repeat -->
                       <th colspan="3" class="tooltip"><span class="tooltiptext">Next Start Time</span><input type="date" size="6" class="name trans" value="<?php echo substr($task['Start'], 0 ,10) ?>"></th>
                     <!-- Time to complete in Minutes -->
                       <th colspan="2" class="tooltip"><span class="tooltiptext">Time Estimate<br>minutes<br>to Complete</span><input type="number" size="2" class="name trans" min="1" max="200" value="<?php echo $task['Time'] ?>"></th>
                     </tr>
                   <!-- Note Row -->
                     <tr id="Note<?php echo $task['Task_ID'] ?>" class="hidden task">
                       <th colspan="6" class="task tooltip"><span class="tooltiptext">Don't forget to:</span><input type="text" size="30" class="trans" placeholder="Note" value="<?php echo $task['Note'] ?>"></th>
                     </tr>
               <?php } ?>

         <?php } ?>
     <!-- </div> -->
   </table>
 </div>
<?php } ?>

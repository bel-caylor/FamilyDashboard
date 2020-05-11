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

     <?php $Users = $_SESSION['users'];
     $type = "";?>
     <!-- Category Rows -->
         <?php while($category = mysqli_fetch_assoc($categories)) { ?>

           <!-- //Import tasks -->
             <?php
               //If $tasks returns rows.
               if ($tasks->num_rows > 0) {
                   //Type Row
                   if ($category['Type'] != $type) {?>
                     <tr class="tblRow">
                       <th  colspan="6"><?php echo "<br>" . strtoupper($category['Type']);?></th>
                     </tr>
                  <?php }
                 ?>
                   <!-- Category Row -->
                     <tr class="tblRow">
                       <th id="rowCat<?php echo $category['Cat_Name_ID'] ?>" colspan="6" class="category"><button id="btncat<?php echo $category['Cat_Name_ID'] ?>" type="button" onclick="editCat(<?php echo $category['Cat_Name_ID'] ?>)"><i class="fas fa-pencil-alt"></i></button><input id="cat<?php echo $category['Cat_Name_ID'] ?>" type="text" class="tblSection" size="15" class="task trans" value="<?php echo $category['Name'] ?>" disabled></th>
                     </tr>
             <?php $type = $category['Type'];} ?>

               <?php
                $tasks = sqlTasks($_SESSION['familyID'], $category['Cat_Name_ID']);
                while($task = mysqli_fetch_assoc($tasks)) { ?>
                   <!-- Task Row -->
                     <tr id="task<?php echo $task['Task_ID'] ?>">
                     <!-- Assigned -->
                       <th colspan="1" class="assigned"><?php echo optionUsers($task['User_ID'], $task['Task_ID'], "saveTask"); ?></th>
                     <!-- Task -->
                       <th colspan="3" class="task"><input type="text" size="15" class="task trans" value="<?php echo $task['Task'] ?>" disabled></th>
                     <!-- Edit -->
                       <th id="EdtTask<?php echo $task['Task_ID'] ?>"><button type="button" onclick="editTask(<?php echo $task['Task_ID'] ?>)"><i class="fas fa-pencil-alt"></i></th>
                     <!-- Delete -->
                       <th id="DelTask<?php echo $task['Task_ID'] ?>"><button type="button" onclick="deleteTask(<?php echo $task['Task_ID'] ?>)"><i class="far fa-trash-alt"></i></th>
                     </tr>
                   <!-- Frequency Row -->
                     <tr id="freqRow<?php echo $task['Task_ID'] ?>" class="hidden">
                     <!-- Freq -->
                       <th colspan="1" class="assigned"><?php echo optionFreq($task['Freq_ID'], $task['Task_ID']); ?></th>
                     <!-- Next Time to Repeat -->
                       <th colspan="3"><input type="date" size="6" class="name trans" value="<?php echo substr($task['Start'], 0 ,10) ?>"></th>
                     <!-- Time to complete in Minutes -->
                       <th colspan="2" class="tooltip"><span class="tooltiptext">Minutes<br>to Complete</span><input type="number" size="2" class="name trans" min="1" max="200" value="<?php echo $task['Time'] ?>"></th>
                     </tr>
                   <!-- Note Row -->
                     <tr id="Note<?php echo $task['Task_ID'] ?>" class="hidden task">
                       <th colspan="6" class="task"><input type="text" size="30" class="trans" placeholder="Note" value="<?php echo $task['Note'] ?>"></th>
                     </tr>
               <?php } ?>

         <?php } ?>
     <!-- </div> -->
   </table>
 </div>
<?php } ?>

<?php
  // Check for login
  if ($_SESSION['currentUserID'] === '') {
    header("Location: " . WWW_ROOT . "/login.php");
  }

  $tasks = sqlGradeTasks();
  if ($tasks->num_rows > 0) {?>

     <div id="gradeTasks">
       <table id="tblGradeTasks" class="table">

         <!-- Name Section -->
         <?php
             $Name = '';
             while($task = mysqli_fetch_assoc($tasks)) {
               if ($Name != $task['Name']) {
         ?>
             <!-- Add Name Section -->
               <tr>
                 <th  colspan="8" class="category"><?php echo $task['User']?></th>
               </tr>
             <?php } ?>

                 <tr id="taskLog<?php echo $task['ID'] ?>">
                     <!-- Grade -->
                       <th colspan="1" class="assigned" class="tooltip">
                         <select id="grade<?php echo $task['ID'] ?>" class="tblInput assigned">
                             <option value="100" selected>A</option>
                             <option value="80">B</option>
                             <option value="60">C</option>
                             <option value="0">F</option>
                         </select>
                       </th>
                     <!-- Time -->
                       <th class="tblInput"><input class="tblNumber" id="time<?php echo $task['ID'] ?>" type="text" size="1" value="<?php echo $task['Time'] ?>"></th>
                     <!-- Task -->
                       <?php if ($task['Name'] != "Main") {$Name = $task['Name'] . "-";} else {$Name = "";} ?>
                       <th colspan="5" class="task"><?php echo $task['Description'] . "-" . $Name . $task['Task']?></th>
                 </tr>
                 <tr id="taskLogNote<?php echo $task['ID'] ?>">
                   <!-- Save -->
                     <th colspan="1" class="tooltip"><span class="tooltiptext">Save<br>Grade</span><button type="button" onclick="saveGrade(<?php echo $task['ID'] ?>)">&#128428;</button></th>
                   <!-- Note -->
                     <th colspan="1" style="text-align: right;">Note:</th>
                     <th colspan="8" class="tblInput task"><input id="note<?php echo $task['ID'] ?>" type="text" size="30" class="task trans" value="<?php echo $task['Note'] ?>" placeholder="What is expected?"></th>
                 </tr>
               <?php $Name = $task['Name'];
               } ?>

         <!-- </div> -->
       </table>
     </div>
     
   <?php
      }else {
        echo "<p class=center>No tasks to grade.</p>";
      } ?>

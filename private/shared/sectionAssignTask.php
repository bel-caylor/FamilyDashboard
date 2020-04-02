<?php
// $familyTasksCat = query_familyTasksCategories($familyID);

//Add Categories
  $arrayCategories = query_familyTasksCategories($familyID);
  $html = "";
  while($category = mysqli_fetch_assoc($arrayCategories)) {
    $html .= '<div id="cat' . $category['Cat_Name_ID'] . '" class="category">';
    $html .= $category['Type'] . '-' . $category['Name'];
    //Add Task row for each category
        $arrayTask = query_tasks($familyID, $category['Cat_Name_ID']);
        $html .= '<div class="table">';
        while($task = mysqli_fetch_assoc($arrayTask)) {
          //Task
          $html .= '<div id="task' . $task['Task_ID'] . '" class="row">';
          $html .= '<div class="task">' . $task['Task'] . '</div>';
          //Assigned - User DropDown
          $html .= optionUsers($familyID, $task['Task_ID'], $task['User_ID']);
          //time
          $html .= '<div class="time">' . $task['Time'] . '</div>';
          $html .= "</div>";  //End Row
        }
        $html .= "</div>";  //Closing for table

      $html .= "</div>"; //Closing for category
    //   $html .= "</div>";
    // $html .= '</div>';
  }
    echo $html;
?>

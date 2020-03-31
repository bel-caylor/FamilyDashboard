<?php
// $familyTasksCat = query_familyTasksCategories($familyID);

  $arrayCategories = query_familyTasksCategories($familyID);
  $html = "";
  while($category = mysqli_fetch_assoc($arrayCategories)) {
    $html = '<div id="cat' . $category['Cat_Name_ID'] . '" class="category">';
    $html .= '<h2>' . $category['Type'] . '-' . $category['Name'] . '</h2>';
    //Add Task for each category
      $arrayTask = query_tasks($familyID, $category['Cat_Name_ID']);
      while($task = mysqli_fetch_assoc($arrayTask)) {
        $html .= "<div>";
        $html .= $task['Task'];
        $html .= "</div>";
      }
      $html .= "<div>";
      $html .= "</div>";
    $html .= '</div>';
    echo $html;
  }


?>

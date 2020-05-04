<?php

function optionUsers($userID = 0, $taskID = 0, $onChange = "") {
  $html = "<select id=\"user$taskID\" name=\"user\" class=\"assigned\" ";
  if ($taskID == 0) {
    $html .= ">";
  }else {
    $html .= "onchange='" . $onChange ."($taskID)'>";
  }
      $html .= "<option value=\"Unassigned\">Unassigned</option>";
      foreach($_SESSION['users'] as $user) {
        $html .= "<option value=" . $user['ID'];
        if ($user['ID'] == $userID) {
          $html .= " selected";
        }
        $html .= ">" . $user['Name'] . "</option>";
      }
      $html .= '</select>';
      echo $html;

}?>

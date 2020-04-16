<?php

function optionUsers($userID, $taskID) {
  $html = "<select id=\"user$taskID\" name=\"user\" class=\"assigned\" onchange=\"saveTask($taskID)\">";
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

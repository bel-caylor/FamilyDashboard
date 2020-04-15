<?php

function optionUsers($userID) {
  $html = "<select id=\"user' . $userID .'\" name=\"user\" class=\"assigned\">";
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

<?php

function optionFreq($freqID = 0, $taskID = 0) {
  $html = "<select id='freq" . $taskID ."' name=\"freq\" class=\"assigned\">";
      foreach($_SESSION['freq'] as $row) {
        $html .= "<option value=" . $row['ID'];
        if ($row['ID'] == $freqID) {
          $html .= " selected";
        }
        $html .= ">" . $row['Frequency'] . "</option>";
      }
      $html .= '</select>';
      echo $html;
}
?>

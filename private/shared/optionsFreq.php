<?php

function optionFreq($freqID) {
  $html = "<select id='freq" . $freqID ."' name=\"freq\" class=\"assigned\">";
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

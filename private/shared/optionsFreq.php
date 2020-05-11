<?php

function optionFreq($freqID = 0, $taskID = 0) {

  //Frequency query
    $freq = sqlSelect("frequency", "ID");
    while($row = mysqli_fetch_assoc($freq)) {
      $_SESSION['freq'][$row['ID']] = $row;
    }

  $html = "<select id='freq" . $taskID ."' name=\"freq\" class=\"assigned\">";
  $html .= "<option value=0>None</option>";
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

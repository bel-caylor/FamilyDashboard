<?php
function optionUsers($Family_ID, $Task_ID, $User_ID) {
  $html = "<select id=`" . $Task_ID . "`>";

  $arrayType = query_Select("users", $Family_ID);
  //Blank Assignment
  if ($User_ID == NULL) {
    $html .= "<option value=`` selected>Assign to</option>";
  }else {
    $html .= "<option value=``>Assign to</option>";
  }
  while($user = mysqli_fetch_assoc($arrayType)) {
    if ($user['ID'] = $User_ID) {
      $html .= "<option value=" . $user['ID'] . " selected>" . $user['Name'] . "</option>";
    }else {
      $html .= "<option value=" . $user['ID'] . ">" . $user['Name'] . "</option>";
    }
  }
  $html .= "</select>";
  return $html;
};
 ?>

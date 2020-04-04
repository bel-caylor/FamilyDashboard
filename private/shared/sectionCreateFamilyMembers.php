<?php

function createFamilyMember($stepID, $familyID = "", $Name = "", $Initial = "", $Admin = "") {
  $html = '<form action="' . WWW_ROOT . '/familySetup.php" method="POST">';
  $html .= '<label for="family">Name:  </label>';
  $html .= '<input type="text" id="name" name="name" value="'  . $Name .  '" maxlength="10" size="10"  pattern="[A-Za-z]{2-10}" required><br>';
  $html .= '<label  class="tooltip" for="Initial"><span class="tooltiptext">Unique for each family member</span>Initial:&nbsp;&nbsp;</label>';
  $html .= '<input type="text" id="Initial" name="Initial" value="'  . $Initial .  '" maxlength="1" size="1" required>';
  // $html .= '(unique for each family member)<br>';
  $html .= '<label for="postalCode"> &nbsp;&nbsp;&nbsp;&nbsp;Admin:  </label>';
  $html .= '<input type="checkbox" id="Admin" name="Admin" value="'  . $Admin .  '"><br>';
  $html .= '<input type="submit" ';
  if ($Name === "") {
    $html .= 'value="Add">';
  }else{
    $html .= 'value="Save Changes">';
    }
  $html .= '</form>';
  return $html;
}

 ?>

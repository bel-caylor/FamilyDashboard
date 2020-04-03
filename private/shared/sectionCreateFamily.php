<?php

function createFamily($stepID, $familyName = "", $postalCode = "", $familyID = "") {
  $html = '<form action="' . WWW_ROOT . '/familySetup.php" method="POST">';
  $html .= '<label for="family">Family Name:  </label>';
  $html .= '<input type="text" id="family" name="family" value="'  . $familyName .  '" maxlength="10" size="10"  pattern="[A-Za-z]{2-10} required><br>';
  $html .= '<label for="postalCode">Postal/Zip Code:  </label>';
  $html .= '<input type="text" id="postalCode" name="postalCode" value="'  . $postalCode .  '" maxlength="10" size="10" required><br>';
  $html .= '<input type="hidden" name="step" value="1">';
  $html .= '<input type="hidden" name="familyID" value="' . $familyID . '">';
  $html .= '<input type="submit" ';
  if ($familyID === "") {
    $html .= 'value="Submit">';
  }else{
    $html .= 'value="Save Changes">';
    }
  $html .= '</form>';
  return $html;
}

 ?>

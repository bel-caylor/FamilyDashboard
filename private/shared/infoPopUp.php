<?php

function infoPopUp($id, $name, $msg, $hidden = "hidden") {
  $html = "<div  id='infoStep" . $id . "' class='popUp ". $hidden . "'>";
  $html .= "<div class='alert'>" . $name;
  $html .= "<p>" . $msg . "</p>";
  $html .= "<button type='button' onclick=toggleInfo('infoStep" . $id . "')>OK</button>";
  $html .= "</div></div>";
  // echo $html;
  return $html;
}

 ?>

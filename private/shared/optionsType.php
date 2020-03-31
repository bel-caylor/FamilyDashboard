<select id="">
<?php
  $arrayType = query_Select("type", "ID");
  $html = "";
  while($type = mysqli_fetch_assoc($arrayType)) {
    $html .= "<option value=" . $type['ID'] . ">" . $type['Type'] . "</option>";
  }
  echo $html;
 ?>
</select>

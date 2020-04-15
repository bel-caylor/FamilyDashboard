<select id="type" name="type" required>
<?php
  $arrayType = sqlSelect("type", "ID");
  $html = "";
  while($type = mysqli_fetch_assoc($arrayType)) {
    $html .= "<option value=" . $type['ID'] . ">" . $type['Type'] . "</option>";
  }
  echo $html;
 ?>
</select>

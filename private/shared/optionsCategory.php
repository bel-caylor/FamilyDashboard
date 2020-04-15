<select id="category" name="category">
<?php
  $arrayType = sqlSelect("frequency", "ID");
  $html = "";
  while($type = mysqli_fetch_assoc($arrayType)) {
    $html .= "<option value=" . $type['ID'] . ">" . $type['Frequency'] . "</option>";
  }
  echo $html;
 ?>
</select>

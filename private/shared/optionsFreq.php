<select id="freq" name="freq">
<?php
  $arrayType = sqlSelect("frequency", "ID");
  $html = "";
  while($frequency = mysqli_fetch_assoc($arrayType)) {
    $html .= "<option value=" . $frequency['ID'] . ">" . $frequency['Frequency'] . "</option>";
  }
  echo $html;
 ?>
</select>

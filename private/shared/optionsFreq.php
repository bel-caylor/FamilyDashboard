<select id="">
<?php
  $arrayType = query_Select("frequency", "ID");
  $html = "";
  while($frequency = mysqli_fetch_assoc($arrayType)) {
    $html .= "<option value=" . $frequency['ID'] . ">" . $frequency['Frequency'] . "</option>";
  }
  echo $html;
 ?>
</select>

<select id="category" name="category">
<?php
  $arrayType = sqlSelect("category", "ID");
  $html = "";
  while($type = mysqli_fetch_assoc($arrayType)) {
    $html .= "<option value=" . $type['ID'] . ">" . $type['Description'] . "</option>";
  }
  echo $html;
 ?>
</select>

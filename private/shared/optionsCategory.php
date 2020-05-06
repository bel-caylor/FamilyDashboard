<select id="category" name="category" placeholder="category">
<?php
  $arrayType = sqlSelect("category", "ID");
  $html = "<option value=0>Category</option>";
  while($type = mysqli_fetch_assoc($arrayType)) {
    $html .= "<option value=" . $type['ID'] . ">" . $type['Description'] . "</option>";
  }
  echo $html;
 ?>
</select>

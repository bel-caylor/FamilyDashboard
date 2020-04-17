<select id="formCategory" name="formCategory" onChange="changeCatName()">
<?php
  $arrayType = sqlCatNames($_SESSION['familyID']);
  $html = "<option value='0'>--NEW--</option>";
  while($type = mysqli_fetch_assoc($arrayType)) {
    $html .= "<option value=" . $type['cat_Name_ID'] . ">" . $type['Description'] . "-" . $type['Name'] . "</option>";
  }
  echo $html;
 ?>
</select>

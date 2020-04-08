<?php

function sqlSelect($table, $orderBy, $ord = 'ASC', $filter = 'NONE', $filterValue = '') {
  $sql = "SELECT * FROM " . $table . " ";
  if ($filter != 'NONE') {
    $sql .= "WHERE " . $filter . " = " . $filterValue . " ";
  };
  $sql .= "ORDER BY " . $orderBy . " " . $ord . " ";
  if (query_db($sql) !== "No data") {
    return query_db($sql);
  }else {
    return "No data returned.";
  }

}

function sqlFamilyTasksCategories($familyID) {
  $sql = "SELECT category_names.ID AS Cat_Name_ID, category_names.Name, category.Type  ";
  $sql .= "FROM category_names, category ";
  $sql .= "WHERE Family_ID = " . $familyID . " AND category_names.Category_ID = category.ID";
  // echo $sql . "<br>";
  return query_db($sql);
}

function sqlTasks($familyID, $Cat_Name_ID) {
  $sql = "SELECT tasks.ID AS Task_ID, tasks.Task, users.ID AS User_ID, users.Name, frequency.Frequency, tasks.Time, tasks.Note ";
  $sql .= "FROM tasks LEFT JOIN users ON tasks.Assigned_User_ID = users.ID ";
  $sql .= "JOIN frequency ON tasks.Freq_ID = frequency.ID ";
  $sql .= "WHERE tasks.Cat_Name_ID = " . $Cat_Name_ID .  " AND tasks.Family_ID = " . $familyID;
  // echo $sql . "<br>";
  return query_db($sql);
}

function sqlUsers($familyID) {
  $sql = "SELECT * FROM `users` ";
  return query_db($sql);
}

function sqlCreateFamily($familyName, $postalCode) {
  $errors = validateFamily($familyName);
  if (!empty($errors)) {return $errors;}

  //Add record
  $sql = "INSERT INTO family ";
  $sql .= "(Family, Postal_Code) ";
  $sql .= "VALUES (";
  $sql .= "'" . $familyName . "',";
  $sql .= "'" . $postalCode . "'";
  // $sql .= "'" . $familyID . "'";
  $sql .= ")";
  $result = insert_db($sql);
  if ($result == "insert failed") {
    return ["insert failed"];
  }else {
    //return ID of new family
    return $result;
  }
}

function sqlEditFamily($familyName, $postalCode, $familyID) {
  $errors = validateFamily($familyName);
  if (!empty($errors)) {return $errors;}

  $sql = "UPDATE family SET ";
  $sql .= "Family='" . $familyName . "', ";
  $sql .= "Postal_Code='" . $postalCode . "' ";
  $sql .= "WHERE ID='" . $familyID . "' ";
  $sql .= "LIMIT 1";
  $result = edit_db($sql);
  if ($result == "edit failed") {
    return ["insert failed"];
  }else {
    return $result;
  }}

//VALIDATION FUNCTIONS
function validateFamily($familyName) {
  $errors = [];
  //Family name
    if(has_length_greater_than($familyName, 1) === 0) {
      $errors[] = "Name must be between 2 and 10 characters.";
    }
  return $errors;
}

 ?>

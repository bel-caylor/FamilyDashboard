<?php

//QUERY FUNCTIONS
function query_db($sql) {
  global $db;
  $data = mysqli_query($db, $sql);
  dbConfirmDataReturned($data);
  return $data;
}

function query_Select($table, $orderBy, $ord = 'ASC', $filter = 'NONE', $filterValue = '') {
  $sql = "SELECT * FROM " . $table . " ";
  if ($filter != 'NONE') {
    $sql .= "WHERE " . $filter . " = " . $filterValue . " ";
  };
  $sql .= "ORDER BY " . $orderBy . " " . $ord . " ";
  return query_db($sql);
}

function query_familyTasksCategories($familyID) {
  $sql = "SELECT category_names.ID AS Cat_Name_ID, category_names.Name, category.Type  ";
  $sql .= "FROM category_names, category ";
  $sql .= "WHERE Family_ID = " . $familyID . " AND category_names.Category_ID = category.ID";
  // echo $sql . "<br>";
  return query_db($sql);
}

function query_tasks($familyID, $Cat_Name_ID) {
  $sql = "SELECT tasks.ID AS Task_ID, tasks.Task, users.ID AS User_ID, users.Name, frequency.Frequency, tasks.Time, tasks.Note ";
  $sql .= "FROM tasks LEFT JOIN users ON tasks.Assigned_User_ID = users.ID ";
  $sql .= "JOIN frequency ON tasks.Freq_ID = frequency.ID ";
  $sql .= "WHERE tasks.Cat_Name_ID = " . $Cat_Name_ID .  " AND tasks.Family_ID = " . $familyID;
  // echo $sql . "<br>";
  return query_db($sql);
}

function query_Users($familyID) {
  $sql = "SELECT * FROM `users` ";
  return query_db($sql);
}

//INSERT FUNCTIONS
function insert_db($sql) {
  global $db;
  $result = mysqli_query($db, $sql);
  if($result) {         //Insert succeeded
    return mysqli_insert_id($db);
  } else {              //Failed change
    echo mysqli_error($db);
    dbDisConnect($db);
    exit;
  }
}

//EDIT FUNCTIONS
function edit_db($sql) {
  global $db;
  $result = mysqli_query($db, $sql);
  if($result) {         //Insert succeeded
    return "Family Updated";
  } else {              //Failed change
    echo mysqli_error($db);
    dbDisConnect($db);
    exit;
  }
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
  //return ID of new family
  return insert_db($sql);
}

function sqlEditFamily($familyName, $postalCode, $familyID) {
  $errors = validateFamily($familyName);
  if (!empty($errors)) {return $errors;}

  $sql = "UPDATE family SET ";
  $sql .= "Family='" . $familyName . "', ";
  $sql .= "Postal_Code='" . $postalCode . "' ";
  $sql .= "WHERE ID='" . $familyID . "' ";
  $sql .= "LIMIT 1";
  return edit_db($sql);
}

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

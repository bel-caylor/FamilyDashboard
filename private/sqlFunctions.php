<?php

function sqlSelect($table, $orderBy, $ord = 'ASC', $filter = 'NONE', $filterValue = '') {
  $errors = array();
  $sql = "SELECT * FROM `" . $table . "` ";
  if ($filter != 'NONE') {
    $sql .= "WHERE " . $filter . "=\"" . $filterValue . "\" ";
  };
  $sql .= "ORDER BY " . $orderBy . " " . $ord . " ";
  // echo $sql;
  $results = query_db($sql);
  // echo "<pre>";
  // print_r($results);
  // echo '</pre>';
  if ($results !== "No data") {
    return query_db($sql);
  }else {
    // array_push($errors,"Passwords DON'T match.");}
    return "No data returned.";
  }
}

function sqlCategories($familyID) {
  $sql = "SELECT category_names.ID AS Cat_Name_ID, category_names.Name, category.Description  ";
  $sql .= "FROM category_names, category ";
  $sql .= "WHERE Family_ID = " . $familyID . " AND category_names.Category_ID = category.ID";
  // echo $sql . "<br>";
  return query_db($sql);
}

function sqlTasks($familyID) {
  $sql = "SELECT tasks.ID AS Task_ID, tasks.Task, `family-members`.ID AS User_ID, `family-members`.Name, frequency.Frequency, tasks.Start, tasks.Time, tasks.Note ";
  $sql .= "FROM tasks LEFT JOIN `family-members` ON tasks.Assigned_User_ID = `family-members`.ID ";
  $sql .= "JOIN frequency ON tasks.Freq_ID = frequency.ID ";
  $sql .= "WHERE tasks.Family_ID = " . $familyID;
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
  if ($result == "update succeeded") {
    return $result;
  }else {
    return ["insert failed"];
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

function sqlAddUser() {
  // $errors = validateUser();
  // if (count($errors) > 0) {return $errors;}

  $sql = "INSERT INTO `family-members` ";
  $sql .= "(Family_ID, Name, Initial, Color, Admin, Email, hashed_password) ";
  $sql .= "VALUES (";
  $sql .= "'" . $_SESSION['familyID'] ."', ";
  $sql .= "'" . $_SESSION['aryUser']['name'] ."', ";
  $sql .= "'" . $_SESSION['aryUser']['initial'] ."', ";
  $sql .= "'" . $_SESSION['aryUser']['color'] ."', ";
  $sql .= "'" . $_SESSION['aryUser']['admin'] ."', ";
  $sql .= "'" . $_SESSION['aryUser']['email'] ."', ";
  $sql .= "'" . password_hash($_SESSION['aryUser']['password1'], PASSWORD_DEFAULT) ."'";
  $sql .= ")";
  //return ID of new family
  $result = insert_db($sql);
  return $result;
}

function sqlEditUser() {
  // $errors = validateUser();
  // if (!empty($errors)) {return $errors;}

  $sql = "UPDATE `family-members` SET ";
  $sql .= "Name='" . $_SESSION['aryUser']['name'] . "', ";
  $sql .= "Initial='" . $_SESSION['aryUser']['initial'] . "', ";
  $sql .= "Color='" . $_SESSION['aryUser']['color'] . "', ";
  $sql .= "Email='" . $_SESSION['aryUser']['email'] . "' ";
  $sql .= "WHERE ID='" . $_SESSION['aryUser']['id'] . "' ";
  $sql .= "LIMIT 1";
  // echo $sql;
  $result = edit_db($sql);
  if ($result == "update succeeded") {
    return $result;
  }else {
    return ["edit failed"];
}}

function sqlDeleteUser($userID) {
  $sql = "DELETE FROM `family-members` ";
  $sql .= "WHERE ID='" . $userID . "' ";
  $sql .= "LIMIT 1";
  $result = edit_db($sql);
  if ($result == "update succeeded") {
    return $result;
  }else {
    return ["delete failed"];
  }
}

function validateUser() {
  // $errors = array();
  //Validate passwords match
    if ($_SESSION['aryUser']['password1'] !== $_SESSION['aryUser']['password2']) {
      array_push($_SESSION['step2Msgs'],"Passwords DON'T match.");}

  //Validate unique User
    foreach($_SESSION['users'] as $user) {
      if ($user['Name'] == $_SESSION['aryUser']['name']) {
        array_push($_SESSION['step2Msgs'],"Duplicate user name.");
        break;}}

  //Validate unique initial
    foreach($_SESSION['users'] as $user) {
      if ($user['Initial'] == $_SESSION['aryUser']['initial']) {
        array_push($_SESSION['step2Msgs'],"Duplicate initial.");}}

  //Validate unique color
    foreach($_SESSION['users'] as $user) {
      if ($user['Color'] == $_SESSION['aryUser']['color']) {
        array_push($_SESSION['step2Msgs'],"Duplicate color.");}}

  //Name
    if(has_presence($_SESSION['aryUser']['name']) != 1) {
        // $errors() = "No Name.";
        array_push($errors,"No Name.");
    }
}

function sqlAddCategory($Category, $Name) {
  $sql = "INSERT INTO `category_names` ";
  $sql .= "(Family_ID, Category_ID, Name) ";
  $sql .= "VALUES (";
  $sql .= "'" . $_SESSION['familyID'] ."', ";
  $sql .= "'" . $Category ."', ";
  $sql .= "'" . $Name ."' ";
  $sql .= ")";
  //return ID of new family
  $result = insert_db($sql);
  return $result;
}

function sqlAddDefaultTasks($Category) {
  //query Default tasks
    $defaultTasks = sqlSelect('default_tasks', 'ID', 'ASC', 'Category_ID', $Category);

  //Add tasks
    foreach ($defaultTasks as $task) {
      $sql = "INSERT INTO `tasks` ";
      $sql .= "(Family_ID, Cat_Name_ID, Task, Freq_ID, Time) ";
      $sql .= "VALUES (";
      $sql .= "'" . $_SESSION['familyID'] ."', ";
      $sql .= "'" . $Category ."', ";
      $sql .= "'" . $task['Task'] ."', ";
      $sql .= "'" . $task['Freq_ID_Default'] ."', ";
      $sql .= "'" . $task['Time_Default'] ."' ";
      $sql .= ")";
      insert_db($sql);
    }
}
 ?>

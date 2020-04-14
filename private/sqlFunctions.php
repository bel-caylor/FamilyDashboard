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
  $errors = validateUser();
  if (!empty($errors)) {return $errors;}

  $sql = "INSERT INTO `family-members` ";
  $sql .= "(Family_ID, Name, Initial, Color, Admin, Email, hashed_password) ";
  $sql .= "VALUES (";
  $sql .= "'" . $_SESSION['familyID'] ."', ";
  $sql .= "'" . $_SESSION['name'] ."', ";
  $sql .= "'" . $_SESSION['initial'] ."', ";
  $sql .= "'" . $_SESSION['color'] ."', ";
  $sql .= "'" . $_SESSION['admin'] ."', ";
  $sql .= "'" . $_SESSION['email'] ."', ";
  $sql .= "'" . password_hash($_SESSION['password'], PASSWORD_DEFAULT) ."'";
  $sql .= ")";
  //return ID of new family
  $result = insert_db($sql);
  return $result;
}

function sqlEditUser() {
  // $errors = validateUser();
  // if (!empty($errors)) {return $errors;}

  $sql = "UPDATE `family-members` SET ";
  $sql .= "Name='" . $_SESSION['name'] . "', ";
  $sql .= "Initial='" . $_SESSION['initial'] . "', ";
  $sql .= "Color='" . $_SESSION['color'] . "', ";
  $sql .= "Email='" . $_SESSION['email'] . "' ";
  $sql .= "WHERE ID='" . $_SESSION['userID'] . "' ";
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
  $errors = array();
  //Validate passwords match
    if ($_POST['password'] !== $_POST['password2']) {
      array_push($_SESSION['step2Msgs'],"Passwords DON'T match.");}

  //Validate unique User
    foreach($_SESSION['users'] as $user) {
      if ($user == $_POST['name']) {
        array_push($_SESSION['step2Msgs'],"Duplicate user name.");}}

  //Validate unique initial
    foreach(array_column($_SESSION['users'], 'initial') as $initial) {
      if ($initial == $_POST['initial']) {
        array_push($_SESSION['step2Msgs'],"Duplicate initial.");}}

  //Validate unique color
    foreach(array_column($_SESSION['users'], 'color') as $color) {
      if ($color == $_POST['color']) {
        array_push($_SESSION['step2Msgs'],"Duplicate color.");}}

  //FamilyID
    // if(has_presence($_SESSION['userID']) !== 1) {
    //   // $errors() = "No familyID.";
    //   array_push($errors,"No familyID.");
    // }
  //Name
    if(has_presence($_SESSION['name']) != 1) {
        // $errors() = "No Name.";
        array_push($errors,"No Name.");
    }
    // echo $errors[0];
    // echo $errors[1];
    return $errors;
}

 ?>

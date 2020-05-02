<?php

function sqlSelect($table, $orderBy, $ord = 'ASC', $filter = 'NONE', $filterValue = '') {
  $errors = array();
  $sql = "SELECT * FROM `" . sqlStrPrep($table) . "` ";
  if ($filter != 'NONE') {
    $sql .= "WHERE " . sqlStrPrep($filter) . "=\"" . sqlStrPrep($filterValue) . "\" ";
  };
  $sql .= "ORDER BY " . sqlStrPrep($orderBy) . " " . sqlStrPrep($ord) . " ";
  // echo $sql;
  $results = query_db($sql);
  // echo "<pre>";
  // print_r($results);
  // echo '</pre>';
  // echo $results;
  if ($results) {
    return query_db($sql);
  }else {
    return "No data returned.";
  }
  // if (mysqli_num_rows($results) === 0) {
  //   return "No data returned.";
  // }else {
  //   return query_db($sql);
  // }
}

function sqlCategories($familyID) {
  $sql = "SELECT category_names.ID AS Cat_Name_ID, category_names.Name, category.Description, category_names.Type_ID, type.Type ";
  $sql .= "FROM category_names ";
  $sql .= "LEFT JOIN category ON category.ID = category_names.Category_ID ";
  $sql .= "LEFT JOIN type ON type.ID = category_names.Type_ID ";
  $sql .= "WHERE Family_ID = " . $familyID . " ";
  $sql .= "ORDER BY Type.ID, Cat_Name_ID ASC";
  // echo $sql . "<br>";
  return query_db($sql);
}

function sqlTasks($familyID, $catID) {
  $sql = "SELECT tasks.ID AS Task_ID, tasks.Task, `family-members`.ID AS User_ID, `family-members`.Name, `tasks`.Freq_ID, frequency.Frequency, tasks.Start, tasks.Time, tasks.Note ";
  $sql .= "FROM tasks LEFT JOIN `family-members` ON tasks.Assigned_User_ID = `family-members`.ID ";
  $sql .= "JOIN frequency ON tasks.Freq_ID = frequency.ID ";
  $sql .= "WHERE tasks.Family_ID = " . $familyID . " AND tasks.Cat_Name_ID = " . $catID;
  // echo $sql . "<br>";
  return query_db($sql);
}

function sqlUsers($familyID) {
  $sql = "SELECT * FROM `users` ";
  $sql = "WHERE Family_ID = " . $familyID;
  return query_db($sql);
}

function sqlCreateFamily($familyName, $postalCode) {
  $errors = validateFamily($familyName);
  if (!empty($errors)) {return $errors;}

  //Add record
  $sql = "INSERT INTO family ";
  $sql .= "(Family, Postal_Code) ";
  $sql .= "VALUES (";
  $sql .= "'" . sqlStrPrep($familyName) . "',";
  $sql .= "'" . sqlStrPrep($postalCode) . "'";
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
  $sql .= "Family='" . sqlStrPrep($familyName) . "', ";
  $sql .= "Postal_Code='" . sqlStrPrep($postalCode) . "' ";
  $sql .= "WHERE ID='" . sqlStrPrep($familyID) . "' ";
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
  $password = sqlStrPrep(password_hash($_SESSION['aryUser']['password1'], PASSWORD_DEFAULT));
  $sql = "INSERT INTO `family-members` ";
  $sql .= "(Family_ID, Name, Initial, Color, Admin, Email, hashed_password) ";
  $sql .= "VALUES (";
  $sql .= "'" . sqlStrPrep($_SESSION['familyID']) ."', ";
  $sql .= "'" . sqlStrPrep($_SESSION['aryUser']['name']) ."', ";
  $sql .= "'" . sqlStrPrep($_SESSION['aryUser']['initial']) ."', ";
  $sql .= "'" . sqlStrPrep($_SESSION['aryUser']['color']) ."', ";
  $sql .= "'" . sqlStrPrep($_SESSION['aryUser']['admin']) ."', ";
  $sql .= "'" . sqlStrPrep($_SESSION['aryUser']['email']) ."', ";
  // $sql .= "'" . password_hash($_SESSION['aryUser']['password1'], PASSWORD_DEFAULT) ."'";
  echo $_SESSION['users'][$_SESSION['currentUserID']]['hashed_password'];
  if ($_SESSION['users'][$_SESSION['currentUserID']]['hashed_password'] != '') {
    $sql .= "'" . $_SESSION['users'][$_SESSION['currentUserID']]['hashed_password'] ."'";
  }else {
    $sql .= "'" . $password ."'";
    $_SESSION['password'] = $password;
  }
  $sql .= ")";
  // echo $sql;
  //return ID of new family
  $result = insert_db($sql);
  // echo $result;
  return $result;
}

function sqlEditUser() {
  // $errors = validateUser();
  // if (!empty($errors)) {return $errors;}

  $sql = "UPDATE `family-members` SET ";
  $sql .= "Name='" . sqlStrPrep($_SESSION['aryUser']['name']) . "', ";
  $sql .= "Initial='" . sqlStrPrep($_SESSION['aryUser']['initial']) . "', ";
  $sql .= "Color='" . sqlStrPrep($_SESSION['aryUser']['color']) . "', ";
  $sql .= "Admin='" . sqlStrPrep($_SESSION['aryUser']['admin']) . "', ";
  $sql .= "Email='" . sqlStrPrep($_SESSION['aryUser']['email']) . "' ";
  $sql .= "WHERE ID='" . sqlStrPrep($_SESSION['aryUser']['id']) . "' ";
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
  $sql .= "WHERE ID='" . sqlStrPrep($userID) . "' ";
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

function sqlAddCategory($Category = 0, $Name, $Type = 1) {

  $duplicateID = sqlCategoryDubplicate($Category, $Name, $Type);
  // echo $duplicateID . "<br>";
  if ($duplicateID > 0) {
    return $duplicateID;
  }

  $sql = "INSERT INTO `category_names` ";
  $sql .= "(Family_ID, Category_ID, Type_ID, Name) ";
  $sql .= "VALUES (";
  $sql .= "'" . $_SESSION['familyID'] ."', ";
  $sql .= "'" . sqlStrPrep($Category) ."', ";
  $sql .= "'" . sqlStrPrep($Type) ."', ";
  $sql .= "'" . sqlStrPrep($Name) ."' ";
  $sql .= ")";
  //return ID of new family
  // echo $sql;
  $result = insert_db($sql);
  return $result;
}

function sqlCategoryDubplicate($Category = 0, $Name) {
  $sql = "SELECT * FROM `category_names` ";
  $sql .= "WHERE Family_ID = " . $_SESSION['familyID'] . " AND ";
  $sql .= "Category_ID = " . sqlStrPrep($Category) . " AND ";
  $sql .= "Name = '" . sqlStrPrep($Name) . "' ";
  // echo $sql . "<br>";
  $result = query_db($sql);
  // print_r($result);
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result)['ID'];
  }
  return 0;
}

function sqlAddTask($input) {
  // $date = date(DATE_ATOM, $input['start']);
  $sql = "INSERT INTO `tasks` ";
  $sql .= "(Family_ID, Cat_Name_ID, Task, Assigned_User_ID, Freq_ID, Start, Time, Note) ";
  $sql .= "VALUES (";
  $sql .= "'" . sqlStrPrep($input['familyID']) ."', ";
  $sql .= "'" . sqlStrPrep($input['catNameID']) ."', ";
  $sql .= "'" . sqlStrPrep($input['task']) ."', ";
  $sql .= "'" . sqlStrPrep($input['userID']) ."', ";
  $sql .= "'" . sqlStrPrep($input['freqID']) ."', ";
  $sql .= "'" . sqlStrPrep($input['start']) ."', ";
  $sql .= "'" . sqlStrPrep($input['time']) ."', ";
  $sql .= "'" . sqlStrPrep($input['note']) ."' ";
  $sql .= ")";
  // echo $sql;
  insert_db($sql);
}

function sqlAddDefaultTasks($category, $catNameID) {
  //query Default tasks
    $defaultTasks = sqlSelect('default_tasks', 'ID', 'ASC', 'Category_ID', $category);
    // print_r($defaultTasks);
    $date = date(DATE_ATOM);

  //Add tasks
    while($task = mysqli_fetch_assoc($defaultTasks)) {
    // foreach ($defaultTasks as $task) {
      $input = array (
        'familyID' => $_SESSION['familyID'],
        'catNameID' => $catNameID,
        'task' => $task['Task'],
        'userID' => '',
        'freqID' => $task['Freq_ID_Default'],
        'start' => $date,
        'time' => $task['Time_Default'],
        'note' => ''
      );
      // print_r($input);
      sqlAddTask($input);
    }
}

function sqlEditTask($input) {
  $sql = "UPDATE `tasks` SET ";
  $sql .= "Task='" . sqlStrPrep($input['task']) . "', ";
  $sql .= "Assigned_User_ID='" . sqlStrPrep($input['user']) . "', ";
  $sql .= "Freq_ID='" . sqlStrPrep($input['freq']) . "', ";
  $sql .= "Start='" . sqlStrPrep($input['start']) . "', ";
  $sql .= "Time='" . sqlStrPrep($input['time']) . "', ";
  $sql .= "Note='" . sqlStrPrep($input['note']) . "' ";
  $sql .= "WHERE ID='" . sqlStrPrep($input['taskID']) . "' ";
  $sql .= "LIMIT 1";
  // echo $sql;
  $result = edit_db($sql);
  if ($result == "update succeeded") {
    return $result;
  }else {
    return ["edit failed"];
  }
}

function sqlAssignTask($input) {
  $sql = "UPDATE `tasks` SET ";
  $sql .= "Assigned_User_ID='" . sqlStrPrep($input['user']) . "' ";
  $sql .= "WHERE ID='" . sqlStrPrep($input['taskID']) . "' ";
  $sql .= "LIMIT 1";
  // echo $sql;
  $result = edit_db($sql);
  if ($result == "update succeeded") {
    return $result;
  }else {
    return ["edit failed"];
  }
}

function sqlDeleteTask($taskID) {
  $sql = "DELETE FROM `tasks` ";
  $sql .= "WHERE ID='" . $taskID . "' ";
  $sql .= "LIMIT 1";
  $result = edit_db($sql);
  if ($result == "update succeeded") {
    return $result;
  }else {
    return ["delete failed"];
  }
}

function sqlCatNames($familyID) {
  $sql = "SELECT category.ID as cat_ID, category.type_ID, category.Description, category_names.ID as cat_Name_ID, category_names.Name ";
  $sql .= "FROM category_names LEFT JOIN `category` ON category_names.Category_ID = category.ID ";
  $sql .= "WHERE category_names.Family_ID = " . $familyID;
  // echo $sql . "<br>";
  return query_db($sql);
}

function sqlAssignedTasks($userID, $date) {
  $sql = "SELECT tasks.ID as taskID, tasks.Time, tasks.Task, category.Description, category_names.Name FROM `tasks` ";
  $sql .= "LEFT JOIN `category_names` ON tasks.Cat_Name_ID = `category_names`.ID  ";
  $sql .= "LEFT JOIN category ON `category_names`.Category_ID = category.ID ";
  $sql .= "WHERE `Assigned_User_ID` = " . $userID . " AND category_names.Type_ID = 1 ";
  $sql .= "AND Start < '" . $date . "' ";
  $sql .= "ORDER BY `Freq_ID` ASC, `Start` ASC";
  // echo $sql;
  return query_db($sql);
}

function sqlHouseTasks($familyID, $date) {
  $sql = "SELECT tasks.ID as taskID, tasks.Time, tasks.Task, category.Description, category_names.Name FROM `tasks` ";
  $sql .= "LEFT JOIN `category_names` ON tasks.Cat_Name_ID = `category_names`.ID  ";
  $sql .= "LEFT JOIN category ON `category_names`.Category_ID = category.ID ";
  $sql .= "WHERE tasks.`Family_ID` = " . $familyID . " AND category_names.Type_ID = 1 ";
  $sql .= "AND tasks.`Assigned_User_ID` = 0 ";
  $sql .= "AND Start < '" . $date . "' ";
  $sql .= "ORDER BY `Freq_ID` ASC, `Start` ASC";
  // echo $sql;
  return query_db($sql);
}

function sqlPersonalTasks($userID, $date) {
  $sql = "SELECT tasks.ID as taskID, tasks.Time, tasks.Task, category.Description, category_names.Name FROM `tasks` ";
  $sql .= "LEFT JOIN `category_names` ON tasks.Cat_Name_ID = `category_names`.ID  ";
  $sql .= "LEFT JOIN category ON `category_names`.Category_ID = category.ID ";
  $sql .= "WHERE `category_names`.`Type_ID` = 2 ";
  $sql .= "AND Start < '" . $date . "' ";
  $sql .= "ORDER BY `Freq_ID` ASC, `Start` ASC";
  return query_db($sql);
}

function sqlAddCompleteTask($input) {
  $sql = "INSERT INTO `task_log` ";
  $sql .= "(Tasks_ID, User_ID, Time) ";
  $sql .= "VALUES (";
  $sql .= "'" . sqlStrPrep($input['taskID']) ."', ";
  $sql .= "'" . sqlStrPrep($input['userID']) ."', ";
  $sql .= "'" . sqlStrPrep($input['time']) ."' ";
  $sql .= ")";
  // echo $sql . "<br>";
  $result = insert_db($sql);
  // echo $result . "<br>";
  return $result;
}

function sqlUpdateNextStart($input) {
  //And remove Assigned_User_ID.
  //query for task freq.
    $sql = "SELECT * FROM `tasks` ";
    $sql .= "JOIN frequency ON tasks.Freq_ID = frequency.ID ";
    $sql .= "WHERE tasks.ID = " . $input['taskID'];
    $result = query_db($sql);
    $row = mysqli_fetch_assoc($result);
    $freq = $row['Hours_Between'];
    $hrOffset = $freq - $input['tzOffset']/60 ;
    // echo $sql . "<br>";
    // echo $freq . "<br>";
    // $date = substr(date(DATE_ATOM),0,16);
    // $date = str_to_date(date(DATE_ATOM));
    $date = date_create();
    // $tzOffset =
    // $date = time() + ($freq * 60 * 60);
    // echo $date;
    $gmtOffset = substr(date_format($date, "P"),1,2);
    $gmtOffset = (int)$gmtOffset;
    // echo $gmtOffset . "<br>";
    $totalOffset = $hrOffset - $gmtOffset;
    // echo $totalOffset . "<br>";
    // echo date_format($date,"Y-m-d H:i:s P") . "<br>";
    //Add frequency to $date.
    date_modify($date,"+" . $totalOffset . " hours");
    //Add timezone offset
    // echo $hrOffset . "<br>";
    // date_modify($date,"+" . $hrOffset . " hours");
    $newStart = date_format($date,"Y-m-d H:i:s");
  //update start time.
    $sql = "UPDATE `tasks` SET ";
    $sql .= "Start='" . $newStart . "', ";
    $sql .= "Assigned_User_ID = 0 ";
    $sql .= "WHERE ID='" . $input['taskID'] . "' ";
    $sql .= "LIMIT 1";
    // echo $sql;
    $result = edit_db($sql);
    // echo $result;
    if ($result == "update succeeded") {
      return $newStart;
    }else {
      return "edit failed";
    }
}

function deleteCompleteTask($taskLogID) {
  $sql = "DELETE FROM `task_log` ";
  $sql .= "WHERE ID='" . $taskLogID . "' ";
  $sql .= "LIMIT 1";
  $result = edit_db($sql);
  if ($result == "update succeeded") {
    return $result;
  }else {
    return ["delete failed"];
  }
}

function editCompleteTasks($input) {
  $sql = "UPDATE `task_log` SET ";
  $sql .= "Time='" . sqlStrPrep($input['time']) . "', ";
  $sql .= "Grade='" . sqlStrPrep($input['grade']) . "', ";
  $sql .= "Note='" . sqlStrPrep($input['note']) . "' ";
  $sql .= "WHERE ID='" . $input['taskLogID'] . "' ";
  $sql .= "LIMIT 1";
  // echo $sql;
  $result = edit_db($sql);
  if ($result == "update succeeded") {
    return $result;
  }else {
    return ["edit failed"];
  }
}

function sqlSumUserLogTime($numDays) {
  $date = date_create();
  date_modify($date,"-" . $numDays . " days");
  $sql = "SELECT User_ID, SUM(Time) FROM `task_log` ";
  $sql .= "WHERE Timestamp > '" . $date . "' ";
  $sql .= "GROUP BY User_ID";
  $sql .= "ORDER BY SUM(Time) DESC";
  return query_db($sql);
}

function sqlSumAssignTime() {
  $sql = "SELECT Assigned_User_ID, `family-members`.Name, `family-members`.Color, `family-members`.Initial, SUM(Time) FROM `tasks` ";
  $sql .= "JOIN `family-members` ON tasks.Assigned_User_ID = `family-members`.ID ";
  $sql .= "WHERE tasks.Family_ID = " . $_SESSION['familyID'] . " ";
  $sql .= "AND Assigned_User_ID != 0 ";
  $sql .= "GROUP BY Assigned_User_ID ";
  $sql .= "ORDER BY SUM(Time) DESC";
  // echo $sql;
  return query_db($sql);
}

function sqlSumTotalAssign() {
  $sql = "SELECT SUM(Time) FROM `tasks` ";
  $sql .= "WHERE Family_ID = '" . $_SESSION['familyID'] . "' ";
  $sql .= "AND Assigned_User_ID != 0 ";
  $sql .= "ORDER BY SUM(Time) DESC";
  // echo $sql;
  return query_db($sql);
}

function sqlSumCompleteByUser($numDays = 7) {
  $sql = "SELECT User_ID, `family-members`.Name, `family-members`.Color, `family-members`.Initial, SUM(Time) FROM `task_log` ";
  $sql .= "JOIN `family-members` ON task_log.User_ID = `family-members`.ID ";
  $sql .= "WHERE task_log.Family_ID = " . $_SESSION['familyID'] . " ";
  $sql .= "GROUP BY User_ID ";
  $sql .= "ORDER BY SUM(Time) DESC";
  // echo $sql . "<br>";
  return query_db($sql);
}

function sqlSumTotalComplete($numDays = 7) {
  $sql = "SELECT SUM(Time) FROM `task_log` ";
  $sql .= "WHERE Family_ID = '" . $_SESSION['familyID'] . "' ";
  $sql .= "ORDER BY SUM(Time) DESC";
  // echo $sql . "<br>";
  return query_db($sql);
}

 ?>

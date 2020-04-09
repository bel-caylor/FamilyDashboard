<?php require_once('../../private/initialize.php');
$errors = [];



//FUNCTIONS
function test_ConnectionFail() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, "DB_ = ");
    return dbConnectConfirm();
}

function test_dbConfirmDataReturned() {
  return sqlSelect('family', ID, $ord = 'ASC', ID, '-1');
}

function test_query_db() {
  $sql = 'SELECT * from NoTable';
  return query_db($sql);
}

function test_insert_db() {
  $sql = "INSERT INTO test ";
  "(NoColumn) ";
  "VALUES ('No')";
  return insert_db($sql);
}

function test_edit_db() {
  $sql = "UPDATE test SET ";
  "Name='Y'";
  "WHERE ID=0 ";
  "LIMIT 1";
  return edit_db($sql);
}

function test_pass_edit_db() {
  $sql = "UPDATE test SET Name='" . time() . "' WHERE ID=1 LIMIT 1";
  return edit_db($sql);
}

// function test_sqlAddUser() {
//   $_SESSION['name'] = '';
//   return sqlAddUser();
// }

// function test_pass_sqlAddUser() {
//   $_SESSION['familyID'] = 1;
//   $_SESSION['name'] = 'Ben';
//   $_SESSION['initial'] = 'B';
//   $_SESSION['color'] = 'test';
//   $_SESSION['admin'] = 1;
//   $_SESSION['email'] = 'test@gmail.com';
//   $_SESSION['password'] = 'password';
//   // $_SESSION['password'] = password_hash("password", PASSWORD_DEFAULT);
//   $result = sqlAddUser();
//   $_SESSION['familyID'] = '';
//   $_SESSION['name'] = '';
//   $_SESSION['initial'] = '';
//   $_SESSION['color'] = '';
//   $_SESSION['admin'] = '';
//   $_SESSION['email'] = '';
//   $_SESSION['password'] = '';
//   return $result;
// }

// function test_sqlEditUser() {
//   $_SESSION['Name'] = '';
//   return sqlEditUser();
// }

function test_pass_sqlEditUser() {
  $_SESSION['name'] = 'Ben2';
  $_SESSION['familyID'] = '1';
  $_SESSION['userID'] = '6';
  $_SESSION['color'] = 'blue';
  return sqlEditUser();
}

function test_validateUser() {
  return validateUser();
}

function test_has_presence() {
  // $_SESSION['familyID'] = '';
  return has_presence($_SESSION['name']);
  // return $_SESSION['name'];

}

$errors[] = "<b>has_presence() -- Pass</b><br>" . test_has_presence() . "<br>";
// $errors[] = "<b>sqlAddUser -- Pass</b><br>" . echoMsgArray(@test_pass_sqlAddUser()) . "<br>";
// $errors[] = "<b>sqlEditUser() -- Pass</b><br>" . echoMsgArray(@test_pass_sqlEditUser()) . "<br>";
$errors[] = "<b>test_validateUser -- Pass</b><br>" . echoMsgArray(@test_validateUser()) . "<br>";
// $errors[] = "<b>dbConnectConfirm -- Fail</b><br>" . @test_pass_sqlEditUser() . "<br>";
// $errors[] = "<b>dbConfirmDataReturned -- Fail</b><br>" . @test_dbConfirmDataReturned() . "<br>";
// $errors[] = "<b>query_db -- Fail</b><br>" . @test_dbConfirmDataReturned() . "<br>";
// $errors[] = "<b>insert_db -- Fail</b><br>" . @test_insert_db() . "<br>";
// $errors[] = "<b>edit_db -- Fail</b><br>" . @test_edit_db() . "<br>";
// $errors[] = "<b>edit_db -- Pass</b><br>" . @test_pass_edit_db() . "<br>";
// $errors[] = "<b>sqlAddUser -- Fail</b><br>" . @test_sqlAddUser() . "<br>";
?>
<body>

  <header>
    <h3>Test SQL Functions</h3>
  </header>

  <main>
    <?php foreach ($errors as $error) {echo $error;}?>
  </main>

</body>

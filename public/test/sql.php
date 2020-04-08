<?php require_once('../../private/initialize.php');
$errors = [];

$errors[] = "<b>dbConnectConfirm -- Fail</b><br>&emsp;" . @test_ConnectionFail() . "<br>";
$errors[] = "<b>dbConfirmDataReturned -- Fail</b><br>&emsp;" . @test_dbConfirmDataReturned() . "<br>";
$errors[] = "<b>query_db -- Fail</b><br>&emsp;" . @test_dbConfirmDataReturned() . "<br>";
$errors[] = "<b>insert_db -- Fail</b><br>&emsp;" . @test_insert_db() . "<br>";
$errors[] = "<b>edit_db -- Fail</b><br>&emsp;" . @test_edit_db() . "<br>";
$errors[] = "<b>edit_db -- Pass</b><br>&emsp;" . @test_pass_edit_db() . "<br>";

?>
<body>

  <header>
    <h3>Test SQL Functions</h3>
  </header>

  <main>
    <?php foreach ($errors as $error) {echo $error;}?>
  </main>

</body>

<?php

//FUNCTIONS
function test_ConnectionFail() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, "DB_NAME");
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
  $sql .= "(NoColumn) ";
  $sql .= "VALUES ('No')";
  return insert_db($sql);
}

function test_edit_db() {
  $sql = "UPDATE test SET ";
  $sql .= "Name='Y'";
  $sql .= "WHERE ID=0 ";
  $sql .= "LIMIT 1";
  return edit_db($sql);
}

function test_pass_edit_db() {
  $sql = "UPDATE test SET Name='" . time() . "' WHERE ID=1 LIMIT 1";
  return edit_db($sql);
}
?>

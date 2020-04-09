<?php require_once('db_credentials.php');

  function dbConnect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    dbConnectConfirm();
    return $connection;
  }

  function dbDisConnect($connection) {
    if(isset($connection)) {mysqli_close($connection);}}

  function dbConnectConfirm() {
    if(mysqli_connect_errno()) {
      $msg = "Database Connect Failed: ";
      $msg .= mysqli_connect_error();
      $msg .= " (" . mysqli_connect_errno() . ")";
      return $msg;}}

  function dbConfirmDataReturned($data) {
    if (is_array($data) == 0) {
      return "TRUE";}}

  //QUERY FUNCTIONS
  //Returns data
  function query_db($sql) {
    global $db;
    $data = mysqli_query($db, $sql);
    if (dbConfirmDataReturned($data) == "TRUE") {
      return $data;
    }else {
      return "No data";
    };

  }

  //INSERT FUNCTION
  //Returns insertID if success
  //Returns 'insert failed' on reject
  function insert_db($sql) {
    global $db;
    $result = mysqli_query($db, $sql);
    // return $result;
    if($result) {         //Insert succeeded
      return mysqli_insert_id($db);
    } else {              //Failed change
      return "insert failed";
    }
  }

  //EDIT FUNCTION
  //Returns 'update succeeded' if success
  //Returns 'update failed' on reject
  function edit_db($sql) {
    global $db;
    $result = mysqli_query($db, $sql);
    // return mysqli_affected_rows($db);
    if(mysqli_affected_rows($db) > 0) {  //Insert succeeded
      return "update succeeded";
    } else {              //Failed change
      return "update failed";
    }
  }

 ?>

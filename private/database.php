<?php

  require_once('db_credentials.php');

  function dbConnect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    dbConnectConfirm();
    return $connection;
  }

  function dbDisConnect($connection) {
    if(isset($connection)) {
      mysqli_close($connection);
    }
  }

  function dbConnectConfirm() {
    if(mysqli_connect_errno()) {
      $msg = "Database Connect Failed: ";
      $msg .= mysqli_connect_error();
      $msg .= " (" . mysqli_connect_errno() . ")";
      exit($msg);
    }
  }

  function dbConfirmDataReturned($data) {
    if (!$data) {
      exit("No data returned from database.");
    }
  }

 ?>

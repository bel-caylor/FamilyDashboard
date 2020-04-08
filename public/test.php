<?php require_once('familySetup/sessionValues.php'); ?>
<?php require_once('../private/initialize.php');
  $_SESSION['status-message'] = [];
  $_SESSION['users'] = array (
    'Darden' => array (
      'id' => 1,
      'initial' => 'D',
      'color' => '$ffffff'
    ),
    'Belinda' => array (
      'id' => 2,
      'initial' => 'B',
      'color' => '$ffffff'
  ));

  $_SESSION['users']['Joshua'] = array(
    'id' => 3,
    'initial' => 'J',
    'color' => '$ffffff'
  );

  echo $_SESSION['users']['Joshua']['initial'] . '<BR>';



  array_push($_SESSION['status-message'],"Passwords DON'T match.");
    array_push($_SESSION['status-message'],"Test.");

  foreach (array_column($_SESSION['users'], 'initial') as $msg) {
    echo $msg . "<br>";
  }

  if ($_SESSION['status-message'] == []) {
    echo "blank";
  }

  echo setValue($_SESSION['color'], "#ffffff");
 ?>

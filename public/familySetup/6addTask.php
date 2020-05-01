<?php require_once('../../private/initialize.php');
  if ($_SESSION['currentUserID'] === '') {
    header("Location: " . WWW_ROOT . "/login.php");
  }
  $userID = '';
  $duplicate = 0;
  $_SESSION['step2Msgs'] = array();
  $_SESSION['step3Msgs'] = array();
  $_SESSION['step4Msgs'] = array();
  $_SESSION['step5Msgs'] = array();

  //NEW Category
  if ($_POST['formCategory'] == 0) {
    //CHECK for duplicate Catergory
    $categories = sqlSelect('category_names', 'ID', 'ASC', 'Family_ID', $_SESSION['familyID']);
    foreach($categories as $category) {
      if ($category['Name'] == $_POST['catName2']) {
        $duplicate = 1;
        $catID = $category['ID'];
        break;
      }
    }
    //No ducplicate found add record
    if ($duplicate == 0) {
      $catID = sqlAddCategory($_POST['formCategory'], $_POST['catName2'], $_POST['type']);
    }
  }

  //Add Room name to category-names.
  if ($_POST['type'] == 2) {
    $userID = $_SESSION['currentUserID'];
  };
  $formDate =strtotime($_POST['start']);
  $date = date(DATE_ATOM, $formDate);
  echo $date . "<br>";
  echo $_POST['start'];
  $input = array (
    'familyID' => $_SESSION['familyID'],
    'catNameID' => $catID ,
    'task' => $_POST['taskDesc'],
    'userID' => $userID,
    'freqID' => $_POST['freq'],
    'start' => $date,
    'time' => $_POST['time'],
    'note' => $_POST['note']
  );

  $_SESSION['input'] = $input;

  $result = sqlAddTask($input);

  if ($result[0] !== "edit failed") {
    //Edit complete.
    echo "Update Succeeded.";
  }else {
    //Edit failed.
    echo "Update Failed. Please try again later.";
  }

  // header("Location: " . WWW_ROOT . "/familySetup.php");  //REDIRECT


?>

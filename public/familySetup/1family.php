<?php require_once('../../private/initialize.php');
  // $expires = time() + 60*60*24*14; //cookie expires in 2 weeks
  $familyID = $_POST['familyID'] ?? $_SESSION['familyID'] ?? '';
  $family = $_POST['family'] ?? $_SESSION['family'] ?? '';
  $postalCode = $_POST['postalCode'] ?? $_SESSION['postalCode'] ?? '';

  if ($familyID == '') {
    $result = sqlCreateFamily(h($family), h($postalCode), $familyID);

    if (is_array($result)) {
      var_dump($result);
      exit;
    }
      $_SESSION['familyID'] = $familyID;
      $_SESSION['family'] = $_POST['family'];
      $_SESSION['postalCode'] = $_POST['postalCode'];
      $_SESSION['step'] = '2';
    header("Location: " . WWW_ROOT . "/familySetup.php");
    exit;

  } else {
    $result = sqlEditFamily($familyName, $postalCode, $familyID);
    echo $result;
  }

 ?>

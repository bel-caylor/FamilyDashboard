<?php require_once('../../private/initialize.php');
  $expires = time() + 60*60*24*14; //cookie expires in 2 weeks
  $familyID = $_POST['familyID'] ?? $_COOKIE['familyID'] ?? '';
  $family = $_POST['family'] ?? $_COOKIE['family'] ?? '';
  $postalCode = $_POST['postalCode'] ?? '';

  if ($familyID == '') {
    $result = sqlCreateFamily(h($family), h($postalCode), $familyID);

    if (is_array($result)) {
      var_dump($result);
      exit;
    }

    setcookie('familyID', $familyID, $expires);
    setcookie('family', $family, $expires);
    setcookie('step', '2', $expires);
    header("Location: " . WWW_ROOT . "/familySetup.php");
    exit;

  } else {
    $result = sqlEditFamily($familyName, $postalCode, $familyID);
    echo $result;
  }

 ?>

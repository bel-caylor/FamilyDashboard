<?php require_once('../../private/initialize.php');

$errors = [];
// $_SESSION['users'] = [];
// // echo $_SESSION['users'];
// $results = sqlSelect("family-members", "ID", "ASC", "Email", "dkcaylor@gmail.com");
// while($row = mysqli_fetch_assoc($results)) {
//   $_SESSION['users'][$row['Name']] = $row;
// };
echo "<pre>";
print_r($_SESSION['users']);
echo "</pre>";


  // echo "<pre>";
  // echo implode(" ", mysqli_fetch_assoc($results));
  // print_r(explode(" ", $row[0]));
  // echo '</pre>';
  // $json = json_encode(mysqli_fetch_assoc($results));
  // echo "<pre>";
  // print_r(mysqli_fetch_assoc($results));
  // echo '</pre>';
// $_SESSION['users']['Darden']['id'] = 45;
// $_SESSION['users']['Belinda']['id'] = 46;
// $_SESSION['users']['Joshua']['id'] = 47;
// echo is_array(array_keys($_SESSION['users']));
// echo '<pre>';
// print_r($_SESSION['users']);
//  echo '</pre>';
// print_r($_SESSION['users']['Darden']['id']);

// @test_ConnectionFail();
// @test_dbConfirmDataReturned();

// $errors[] = @test_ConnectionFail();
// $errors[] = @test_dbConfirmDataReturned();

// foreach($errors as $error => $value) {
//   echo '<p>' . $value . '</p>';
// }

// function test_ConnectionFail() {
//     $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, "DB_NAME");
//     dbConnectConfirm();
// }

// function test_dbConfirmDataReturned() {
//   sqlSelect('family', ID, $ord = 'ASC', ID, '-1');
// }

  // $_SESSION['status-message'] = [];
  // $_SESSION['users'] = array (
  //   'Darden' => array (
  //     'id' => 1,
  //     'initial' => 'D',
  //     'color' => '$ffffff'
  //   ),
  //   'Belinda' => array (
  //     'id' => 2,
  //     'initial' => 'B',
  //     'color' => '$ffffff'
  // ));
  //
  // $_SESSION['users']['Joshua'] = array(
  //   'id' => 3,
  //   'initial' => 'J',
  //   'color' => '$ffffff'
  // );

  // echo $_SESSION['users']['Joshua']['initial'] . '<BR>';

  // array_push($_SESSION['status-message'],"Passwords DON'T match.");
  //   array_push($_SESSION['status-message'],"Test.");
  //
  // foreach (array_column($_SESSION['users'], 'initial') as $msg) {
  //   echo $msg . "<br>";
  // }
  //
  // if ($_SESSION['status-message'] == []) {
  //   echo "blank";
  // }
  //
  // echo setValue($_SESSION['color'], "#ffffff");

  // echo test();
  //
  // function test() {
  //   return ["insert failed"];
  // }
 ?>
<!-- <body>
  <header>
    Test Scripts
  </header>
  <main> -->


  <!-- </main>
</body> -->

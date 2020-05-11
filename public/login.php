<!-- Need to troubleshoot password. -->

<?php require_once('../private/initialize.php');
$step = "1-email";
$stepID = $_POST['StepID'] ?? '';
   if($_SERVER['REQUEST_METHOD'] == 'POST') {
     $_SESSION['email'] = $_POST['email'] ?? $_SESSION['email'];
     if ($_SESSION['email'] != '') {
       switch ($stepID) {
         case '1':  //Enter Email
            $results = sqlSelect("family-members", "ID", "ASC", "Email", $_SESSION['email']);
          //No DATA
            if (mysqli_num_rows($results) === 0) {
              $_SESSION['admin'] = 1;
              // $step = '2-createFamily';
              header("Location: " . WWW_ROOT . "/familySetup.php");
              break;
            }
          //Set $_SESSION VALUES
            //Create users array
            while($row = mysqli_fetch_assoc($results)) {
              $_SESSION['users'][$row['ID']] = $row;
            };
            // $_SESSION['users'] = $results;
            $users = $_SESSION['users'];
            $userIDs = array_keys($_SESSION['users']);
            $_SESSION['familyID'] = $_SESSION['users'][$userIDs[0]]['Family_ID'];
            $family = mysqli_fetch_assoc(sqlSelect("family", "ID", "ASC", "ID", $_SESSION['familyID']));
            $_SESSION['family'] = $family['Family'];
            $_SESSION['postalCode'] =$family['Postal_Code'];
          //Multipule Users
            if (mysqli_num_rows($results) > 1) {
              $step = '3-selectUser';
              break;
            }else {
              //Set current user.
              $results = sqlSelect("family-members", "ID", "ASC", "Email", $_SESSION['email']);
              $row = mysqli_fetch_assoc($results);
              $_SESSION['currentUserID'] = $row['ID'];
              $_SESSION['password'] = $_SESSION['users'][$_SESSION['currentUserID']]['hashed_password'];
              $_SESSION['admin'] = $_SESSION['users'][$_SESSION['currentUserID']]['Admin'];
            }
          //One User
            $step = '4-password';
            break;

         case '3':  //Select User
           $_SESSION['currentUserID'] = $_POST['User'];
           $step = '4-password';
           break;
         case '4':  //Check password
            $user = mysqli_fetch_assoc(sqlSelect("family-members", "ID", "ASC", "ID", $_SESSION['currentUserID']));
            if(password_verify($_POST['password'], $_SESSION['users'][$_SESSION['currentUserID']]['hashed_password'])) {
              $_SESSION['currentName'] = $_SESSION['users'][$_SESSION['currentUserID']]['Name'];
              $_SESSION['password'] = $_SESSION['users'][$_SESSION['currentUserID']]['hashed_password'];
              $_SESSION['admin'] = $_SESSION['users'][$_SESSION['currentUserID']]['Admin'];
              header("Location: " . WWW_ROOT . "/dashboard.php");
              exit;
            }else {  //Invalid Password
              $step = '5-invalid';
            };

       }
       //Check for Users with that Email
     }
   }else {
     session_destroy();
   }
   $stepID = substr($step, 0, 1)
?>
<?php include(SHARED_PATH . '/header.php') ?>

  <main>
    <br><br>
  <!-- EMAIL -->
    <h2 class="section"><span <?php if ($stepID>2) {echo " class='hidden'";} ?>>Enter&nbsp;</span>E-mail</h2>
    <form class="form" action="<?php echo WWW_ROOT?>/login.php" method="post">
      <input type="email" name="email" placeholder="Email Address" value="<?php echo $_SESSION['email'] ?>" <?php if ($stepID>2) {echo " disabled";} ?>>
      <input type="hidden" name="StepID" value="1">
      <input <?php if ($stepID>2) {echo "class=\"hidden\" ";} ?> type="submit" value="Submit">
    </form>

  <!-- CREATE FAMILY -->
    <div class="status-message" <?php if ($stepID != 2) {echo " hidden";} ?>>
      <p>E-mail doesn't exist.<br>Do you want to create a NEW Family?</p>
      <p><a href="<?php echo WWW_ROOT ?>/familySetup.php">Create Family</a></p>
    </div>

  <!-- SELECT USER -->
    <div <?php if ($stepID != 3) {echo " hidden";} ?>>
      <h2 class="section">Select User</h2>
      <form class="form" action="<?php echo WWW_ROOT?>/login.php?" method="post">
        <?php
          if (mysqli_num_rows($results) > 0) {
            $count = 1;
            $checked = " checked";
            foreach($userIDs as $ID) {
              if ($count > 1) {
                $checked = "";
              };
              echo "<input type='radio' id='" . $ID . "' name='User' value='" . $ID . "' " . $checked .  ">";
              echo "<label for='" . $_SESSION['users'][$ID]['Name'] . "'>" . $_SESSION['users'][$ID]['Name'] . "</label><br>";
              $count = $count + 1;
            }
            // while($row = mysqli_fetch_assoc($users)) {
            //
            // }
          }
        ?>
        <input type="hidden" name="StepID" value="3">
        <input type="submit" value="Submit" <?php if ($stepID != 3) {echo " hidden";} ?>>
      </form>
    </div>

  <!-- ENTER PASSWORD  -->
    <div <?php if ($stepID < 4) {echo " hidden";} ?>>
      <h2 class="section">Enter Password</h2>
      <form class="form" action="<?php echo WWW_ROOT?>/login.php" method="post">
        <input type="password" name="password" placeholder="password">
        <input type="hidden" name="StepID" value="4">
        <input type="submit" value="Submit">
      </form>
    </div>

    <!-- CREATE FAMILY -->
      <div class="form status-message" <?php if ($stepID != 5) {echo " hidden";} ?>>
        <p>Login Failed</p>
      </div>

  </main>
</body>

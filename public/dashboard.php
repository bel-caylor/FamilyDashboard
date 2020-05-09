<?php require_once('../private/initialize.php');

//Check for LOGIN
  if ($_SESSION['currentUserID'] === '') {
    header("Location: " . WWW_ROOT . "/login.php");
  }

  //Create users array
  $_SESSION['users'] = [];
  $results = sqlSelect("family-members", "ID", "ASC", "Family_ID", $_SESSION['familyID']);
  while($row = mysqli_fetch_assoc($results)) {
    $_SESSION['users'][$row['ID']] = $row;
  };

  //header
  $header = $_SESSION['currentName'] . "`s Dashboard<br>";
  include(SHARED_PATH . '/headerDashboard.php');

// Complete Task Section
  echo section("Step2", "Complete Tasks");
  // Info Message
    echo infoPopUp(2,
      "Complete Task Info",
      "Click on checkbox to complete task.<p>
      Task time will be added to your total time.");

  // Complete Tasks Table
    include(PUBLIC_PATH . '\dashboard\2tblCompleteTasks.php');

//ADMIN section
if ($_SESSION['admin'] == 1) {

  // Grade Task Section
    echo section("Step3", "Grade Tasks");
    // Info Message
      echo infoPopUp(3,
        "Grade Task Info",
        "Use this to verify tasks were done.<p>
        Based on the grade the minutes will be subtracted from time total.");

    // Complete Tasks Table
      include(PUBLIC_PATH . '\dashboard\3tblGradeTasks.php');

  // Assign Task Section
    echo section("Step4", "Assign Tasks");
    // Info Message
      echo infoPopUp(4,
        "Assign Task Info",
        "ONE TIME assign task to family member.");

    // Complete Tasks Table
      include(PUBLIC_PATH . '\dashboard\4tblAssign.php');

}
?>

  <!-- Go to familySetup -->
      <div class="section <?php if ($_SESSION['admin'] == 0) {echo "hidden";} ?>">
        <br><br>
        <button onclick="window.location='familySetup.php'">
          <h2 id="reports">&#9660; Setup Tasks</h2>
        </button>
      </div>
</section>


  </main>
<?php include(SHARED_PATH . '/footer.php') ?>

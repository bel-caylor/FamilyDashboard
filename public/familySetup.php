<?php require_once('../private/initialize.php');

//Check permissions.
  if ($_SESSION['step'] > 2 AND $_SESSION['admin'] == 0) {
    header("Location: " . WWW_ROOT . "/dashboard.php");
  }

//Session Parimeters
  if ($_SESSION['step'] == 1) {
    if ($_SESSION['family'] !== "") {$_SESSION['step'] = 2;}
    if ($_SESSION['currentUserID'] !== "") {$_SESSION['step'] = 4;}
  }

//Create users array
  $_SESSION['users'] = [];
  $results = sqlSelect("family-members", "ID", "ASC", "Family_ID", $_SESSION['familyID']);
  while($row = mysqli_fetch_assoc($results)) {
    $_SESSION['users'][$row['ID']] = $row;
  };

//HEADER
  if ($_SESSION['family'] !== "") {
    $header = $_SESSION['family'] . " Dashboard";
  }else{
    $header = 'Welcome to Family Dashboard';
  }
  include(SHARED_PATH . '/header.php');

//STEP 1 - Create/Edit Family
    if ($_SESSION['step'] == '1') {$name = "Add Family";}else {$name = "Edit Family";}
    echo section("Step1", $name);

  // Welcome Message
      $hidden = "hidden";
        if ($_SESSION['step'] == '1') {$hidden = '';}
        echo infoPopUp(1,
          "Family Dashboard Info",
          "Use this tool to help you<br>keep your family on task.<p>
            Setup tasks by room and assign<br>them to family members.<p>
            Family Members can login<br>and complete tasks.<p>
            Dashboard will calculate how many<br>minutes they have completed.<p>
            Parents can grade completed tasks.<p>
            Thanks for visiting!<p>",
           $hidden);
   //CREATE Family Form
    include(PUBLIC_PATH . '/familySetup/1form.php');

// STEP 3 - Edit Users
if ($_SESSION['step']>2) {
  echo section("Step3", "Edit Users");
  // Info Message
    echo infoPopUp(3,
      "Edit Users Info",
      "Click on PENCIL icon to edit user.<p>
      Don't forget to save user <br>
      by clicking on DISK icon.");

  // ADD Users Form
    include(PUBLIC_PATH . '/familySetup/3tblUsers.php');
}

//STEP 2 - Add Family Members
if ($_SESSION['step']>1) {
    echo section("Step2", "Add Users");
    // Info Message
      echo infoPopUp(2,
        "Add Users Info",
        "Add each member of your family.<p>
          Select unique INITIAL and COLOR<br>
          for each member these will <br>
          be used for reporting charts.<p>
          E-Mails will be used for login and<br>
          can be the same for family <br>
          members without e-mails.<p>
          ADMINISTRATORS will be able to<br>
          - create/edit/delete family members<br>
          - add/assign/grade tasks");

    // ADD Users Form
      include(PUBLIC_PATH . '/familySetup/2formAddUser.php');
}

// STEP 4 - Add Tasks
if ($_SESSION['step']>3) {
  echo section("Step4", "Add Room Tasks");
  // Info Message
    echo infoPopUp(4,
      "Add Room Tasks Info",
      "Use this section to add task categories.<p>
        For example 'Master Bath' or 'Kitchen'.<p>
        Select a Type to import<br>
        default tasks for that category.");

  // ADD Room Tasks Form
    include(PUBLIC_PATH . '/familySetup/4formAddTasks.php');

  // STEP 6 - Create Tasks
    echo section("Step6", "Add Custom Tasks");
    // Info Message
      echo infoPopUp(6,
        "Create Tasks Info",
        "Use this section to create <br>
          CUSTOM task categories and tasks.<p>
          FREQUENCY dropdown determines <br>
          how often task is added to list.<p>
          Start DATE is recalculated every time<br>
          a task is completed based on frequency.<p>
          Time Estimate NUMBER is based on <br>
          number of minutes to complete the task.");

    // Create Task Form
      include(PUBLIC_PATH . '/familySetup/6formCreateTask.php');

// STEP 5 - Edit Tasks
    echo section("Step5", "Edit Tasks");
    // Info Message
      echo infoPopUp(5,
        "Edit Tasks Info",
        "Use Unassigned DROPDOWN for tasks  <br>
          that are ALWAYS assigned to that user.<p>

          ");

    // Create Task Form
      include(PUBLIC_PATH . '/familySetup/5tblTasks.php');

?>
<!-- Go to Dashboard -->
        <div class="section">
          <button onclick="window.location='dashboard.php'">
            <h2 id="reports">&#9660; Goto Dashboard</h2>
          </button>
        </div>
  </main>

<?php } ?>

<?php include(SHARED_PATH . '/footer.php') ?>

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
    $header = $_SESSION['family'] . " Family Setup";
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
          "Use this tool to help you keep your family on task.<p>
            Setup tasks by room and assign them to family members.<p>
            Family Members can login and complete tasks.<p>
            Dashboard will calculate how many minutes they have completed.<p>
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
      "Click on PENCIL <i class='fas fa-pencil-alt'></i> icon to edit user.<p>
      Don't forget to SAVE <i class='far fa-save'></i> user
      by clicking on DISK icon.<p>
      <i class='far fa-trash-alt'></i> is DELETE task button.");

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
          Select unique INITIAL and COLOR
          for each member these will
          be used for reporting charts.<p>
          E-Mails will be used for login and
          can be the same for family
          members without e-mails.<p>
          ADMINISTRATORS will be able to
          - create/edit/delete family members
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
        Select a Type to import
        default tasks for that category.");

  // ADD Room Tasks Form
    include(PUBLIC_PATH . '/familySetup/4formAddTasks.php');

  // STEP 6 - Create Tasks
    echo section("Step6", "Add Custom Tasks");
    // Info Message
      echo infoPopUp(6,
        "Create Tasks Info",
        "Use this section to create
          CUSTOM task categories and tasks.<p>
          FREQUENCY dropdown determines
          how often task is added to list.<p>
          Start DATE is recalculated every time
          a task is completed based on frequency.<p>
          Time Estimate NUMBER is based on
          number of minutes to complete the task.");

    // Create Task Form
      include(PUBLIC_PATH . '/familySetup/6formCreateTask.php');

// STEP 5 - Edit Tasks
    echo section("Step5", "Edit Tasks");
    // Info Message
      echo infoPopUp(5,
        "Edit Tasks Info",
        "Use Unassigned DROPDOWN for tasks
          that are ALWAYS assigned to that user.<p>
          Date is start date.<p>
          Number is time in minutes.<p>
          <i class='fas fa-pencil-alt'></i> is EDIT task button.<p>
          <i class='far fa-trash-alt'></i> is DELETE task button.<p>
          <i class='far fa-save'></i> is SAVE task button.
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

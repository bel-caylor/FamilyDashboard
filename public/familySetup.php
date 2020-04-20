<?php require_once('../private/initialize.php'); ?>
<?php
  //Session Parimeters
  if ($_SESSION['family'] !== "") {$_SESSION['step'] = 2;}
  if ($_SESSION['currentUserID'] !== "") {$_SESSION['step'] = 4;}

  if ($_SESSION['family'] !== "") {
    $header = $_SESSION['family'] . " Dashboard";
  }else{
    $header = 'Welcome to Family Dashboard';
  }

  //NEED TO ADD ERROR HANDLING!!!
  // echo $stepID;
  // echo $_SERVER['REQUEST_METHOD'];

 ?>

 <?php include(SHARED_PATH . '/header.php') ?>

<body onload="onLoad()">
  <header>
    <?php echo $header . '<br>';?>
  </header>

  <main>
      <br>
<!-- Step 1 - Create/Edit Family  -->
    <div class="section inline">
      <button onclick="clickExpandBtn('Step1')">
        <h2 id="head1" class="inline">&#9660;
          <?php if ($_SESSION['step'] == '1') {echo "Create Family";}else {echo "Edit Family";}?>
        </h2>
      </button>
    </div>

    <!-- CREATE Family Form -->
    <!-- Hide section if moving onto Step 2. -->
    <div id="Step1" class="form<?php if ($_SESSION['step'] > 2) {echo " hidden";} ?>">
      <form id="form1" action="<?php echo WWW_ROOT?>/familySetup/1family.php" method="POST">
        <fieldset>
          <label  for="family" class="tooltip"><span class="tooltiptext">Last name</span>Family Name:  </label>
          <input type="text" id="family" name="family" value="<?php echo  $_SESSION['family'] ?>" maxlength="10" size="10" pattern="[A-Za-z]{2,10}" title="Must be 2-10 letters." required><br>
          <label for="postalCode" class="tooltip"><span class="tooltiptext">ZIP Code</span>Postal Code:  </label>
          <input type="text" id="postalCode" name="postalCode" value="<?php echo $_SESSION['postalCode']?>" maxlength="10" size="10" required><br>
          <p role="alert" class="status-failure" hidden>Connection failure, please try again.</p>
          <p role="alert" class="status-busy" hidden>Busy sending data, please wait.</p>
          <p role="alert" class="status-message" <?php if ($_SESSION['step1Msgs'] == []) {echo "hidden";} ?>>
            <?php if ($_SESSION['step1Msgs'] !== []) {echo echoMsgArray($_SESSION['step1Msgs']);} ?></p>
          <input id="btn1" type="submit" <?php if ($_SESSION['step'] == '1') {echo 'value="Submit">';} else {echo 'value="Save Changes">';}?>
        </fieldset>
      </form>
    </div>

    <!-- Step 2 - Add Family Members -->
    <div class="section inline">
      <button onclick="clickExpandBtn('Step2')">
        <h2 class="inline">&#9660; Add Users</h2>
      </button>
    </div>

    <!-- CREATE Users Form -->
    <?php  //Form Values
      $name = $_SESSION['aryUser']['name'] ?? '';
      $initial = $_SESSION['aryUser']['initial'] ?? '';
      $color = $_SESSION['aryUser']['color'] ?? '';
      $email = $_SESSION['aryUser']['email'] ?? '';
      $admin = $_SESSION['aryUser']['admin'] ?? '';
     ?>
    <div id="Step2" class="form"<?php if ($_SESSION['step'] > 3) {echo " hidden";}?>>
      <form id="form2" action="<?php echo WWW_ROOT?>/familySetup/2addUser.php" method="POST">
        <fieldset>
          <!-- <label for="name">Name:  </label> -->
          <input type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="User Name" maxlength="10" size="10" pattern="[A-Za-z]{2,10}" title="Must be 2-10 letters." required>&nbsp;&nbsp;
          <label class="tooltip" for="initial"><span class="tooltiptext">Unique for each family member</span>Initial:
          <input type="text" id="initial" name="initial" value="<?php echo $initial; ?>" maxlength="1" size="1" required></label><br>
          <label class="tooltip" for="color"><span class="tooltiptext">Unique color<br>for reporting.</span>Color:
          <input type="color" id="color" name="color" value="<?php echo setValue($color, "#337AFF"); ?>"></label>
          <label class="tooltip" for="admin"><span class="tooltiptext">Able to create/assign<br>& grade tasks.</span> &nbsp;&nbsp;&nbsp;&nbsp;Admin:
          <input type="checkbox" id="admin" name="admin" value="<?php echo setValue($admin, "1"); ?>"></label><br>
          <label class="tooltip" for="email"><span class="tooltiptext">Email will be<br>used for login.</span>Email:  </label>
          <input type="text" id="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>"maxlength="255" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter valide email." required><br>
          <div id="pwds"<?php if ($_SESSION['currentUserID'] !== '') {echo " hidden";}?>>
            <label class="tooltip" for="password"><span class="tooltiptext">Initial passwords for users will all be identical.</span>Password:  </label>
            <input type="button" value="View passwords" onclick="togglePwdVisible()"><br>
            <input type="password" id="password1" name="password1" placeholder="Create password" maxlength="10" size="15" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" <?php if ($_SESSION['currentUserID'] == '') {echo " required";}?>>&nbsp;&nbsp;
            <input type="password" id="password2" name="password2" placeholder="Re-type password" maxlength="255" size="15" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" <?php if ($_SESSION['currentUserID'] == '') {echo " required";}?>><br>
            Must be 8 to 10 characters long and contain at least one number and one uppercase and lowercase letter.<br>
          </div>
          <p role="alert" class="status-failure" hidden>Connection failure, please try again.</p>
          <p role="alert" class="status-busy" hidden>Busy sending data, please wait.</p>
          <p role="alert" id="step2Msgs" class="status-message"><?php echo echoMsgArray($_SESSION['step2Msgs']); ?></p>
          <input type="submit" value="Add">
        </fieldset>
      </form>
    </div>

    <!-- Step 3 - Edit Users -->
    <div class="section inline">
      <button onclick="clickExpandBtn('Step3')">
        <h2 class="inline">&#9660; Edit Users</h2>
      </button>
      <p role="alert" id="step3Msgs" class="status-message"><?php if ($_SESSION['step3Msgs'] !== []) {echo echoMsgArray($_SESSION['step3Msgs']);} ?></p>
    </div>

    <div id="Step3" class="<?php if ($_SESSION['step'] > 3) {echo " hidden";}?>" >
      <?php include(PUBLIC_PATH . '/familySetup/3tblUsers.php') ?>
    </div>

    <!-- Step 4 - Add Tasks  -->
    <div id="Step4" class="section inline">
      <button onclick="clickExpandBtn('addTasks')">
        <h2 class="inline">&#9660; Add Categories</h2>
      </button>
    </div>

    <div id="addTasks" class="<?php if ($_SESSION['step'] < 3) {echo " hidden";}?>">
      <div class="form">
        <form id="form4" action="<?php echo WWW_ROOT?>/familySetup/4addCategory.php" method="POST">
          <fieldset>
            <label class="tooltip" for="category"><span class="tooltiptext">Category Type</span>Type:
            <?php include(PRIVATE_PATH . '/shared/optionsCategory.php') ?></label><br>
            <label class="tooltip" for="name"><span class="tooltiptext">Room name:</span>Name:
            <input type="text" id="catName" name="catName" value="Master" maxlength="20" size="10" required></label><br>
            <label class="tooltip" for="defaultTasks"><span class="tooltiptext">Import default tasks for category type.</span>Default Tasks:
            <input type="checkbox" id="defaultTasks" name="defaultTasks" checked></label><br>
            <input type="submit" value="Add Category">
          </fieldset>
        </form>
      </div>
    </div>

    <!-- Step 5 - Edit Frequency, Delete Unwanted, Add Additional -->
    <div id="Step5" class="section inline">
      <button onclick="clickExpandBtn('editTasks')">
        <h2 class="inline">&#9660; Edit Tasks</h2>
      </button>
    </div>

    <div id="editTasks" class="<?php if ($_SESSION['step'] < 4) {echo " hidden";}?>" >
      <p role="alert" id="step5Msgs" class="status-message"><?php if ($_SESSION['step5Msgs'] !== []) {echo echoMsgArray($_SESSION['step5Msgs']);} ?></p>
      <?php include(PUBLIC_PATH . '/familySetup/5tblTasks.php') ?>
    </div>

<!-- Step 6 Create New Task -->
    <div id="Step6" class="section inline">
      <button onclick="clickExpandBtn('createTasks')">
        <h2 class="inline">&#9660; Create Tasks</h2>
      </button>
    </div>

    <div id="createTasks" class="<?php if ($_SESSION['step'] < 4) {echo " hidden";}?>" >
      <p role="alert" id="step6Msgs" class="status-message"><?php if ($_SESSION['step6Msgs'] !== []) {echo echoMsgArray($_SESSION['step6Msgs']);} ?></p>
      <div class="form">
        <form id="form6" action="<?php echo WWW_ROOT?>/familySetup/6addTask.php" method="POST">
          <table class="formTable">
        <!-- Category Type -->
            <tr>
              <th class="formLabel">Category Name:</th>
              <th class="formInput"><?php include(PRIVATE_PATH . '/shared/optionsCatName.php') ?></th>
            </tr>
        <!-- Type -->
            <tr id="typeRow">
              <th class="formLabel">Type:</th>
              <th class="formInput"><?php include(PRIVATE_PATH . '/shared/optionsType.php') ?></th>
            </tr>
      <!-- Category Name -->
            <tr id="newCat">
              <th class="formLabel">Category Name:</th>
              <th class="formInput"><input type="text" id="catName2" name="catName2" placeholder="description" maxlength="20" size="10" required></th>
            </tr>
      <!-- Description -->
            <tr>
              <th class="formLabel tooltip"><span class="tooltiptext">Details</span>Task:</th>
              <th class="formInput"><input type="text" id="taskDesc" name="taskDesc" placeholder="description" maxlength="30" size="10" required></th>
            </tr>
      <!-- Frequency -->
            <tr>
              <th class="formLabel">Frequency:</th>
              <th class="formInput"><?php echo optionFreq($task['Freq_ID'], $task['Task_ID']); ?></th>
            </tr>
      <!-- Start -->
            <tr class="formInput">
              <th class="formLabel tooltip"><span class="tooltiptext">Date to start task.</span>Start:</th>
              <th class="formInput"><input id="start" name="start" type="date" size="4" class="name"></th>
            </tr>
      <!-- Time Estimate -->
            <tr>
              <th class="formLabel tooltip"><span class="tooltiptext">in minutes</span>Time Estimate:</th>
              <th class="formInput"><input type="number" name="time" size="2" class="name" min="1" max="200" value="1"></th>
            </tr>
      <!-- Note -->
            <tr>
              <th class="formInput tooltip" colspan="2"><span class="tooltiptext">Don't forget to:</span>
                <input type="text" name="note" size="28" placeholder="Note"></th>
            </tr>
      <!-- Submit -->
            <tr>
              <th colspan="2"><input type="submit" value="Add Task"></th>
            </tr>
          </table>
        </form>
      </div>
    </div>

  </main>
<?php include(SHARED_PATH . '/footer.php') ?>

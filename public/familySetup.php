<?php require_once('../private/initialize.php'); ?>
<?php
  //Session Parimeters
  if ($_SESSION['family'] !== "") {$_SESSION['step'] = 2;}
  if ($_SESSION['currentUserID'] !== "") {$_SESSION['step'] = 3;}

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

<body>
  <header>
    <?php echo $header . '<br>';?>
  </header>

  <main>
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
    <div id="Step2" class="form"<?php if ($_SESSION['step'] < 2) {echo " hidden";}?>>
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
          <p role="alert" class="status-message"><?php if ($_SESSION['step2Msgs'] !== []) {echo echoMsgArray($_SESSION['step2Msgs']);} ?></p>
          <input type="submit" value="Add">
        </fieldset>
      </form>
    </div>

    <!-- Step 3 - Edit Users -->
    <div class="section inline">
      <button onclick="clickExpandBtn('Step3')">
        <h2 class="inline">&#9660; Edit Users</h2>
      </button>
    </div>

    <div id="Step3" <?php if ($_SESSION['step'] < 3) {echo " hidden";}?> >
      <p role="alert" id="step3Msgs"><?php if ($_SESSION['step3Msgs'] !== []) {echo echoMsgArray($_SESSION['step3Msgs']);} ?></p>
      <?php include(PUBLIC_PATH . '/familySetup/tblUsers.php') ?>
    </div>

    <!-- Step 3 - Add Categories  -->
    <div id="Step3" class="section inline">
      <button onclick="clickExpandBtn('addCategories')">
        <h2 class="inline">&#9660; Add Categories</h2>
      </button>
    </div>

    <!-- Step 4 - Import Default Tasks  -->
    <div id="Step4" class="section inline">
      <button onclick="clickExpandBtn('importTasks')">
        <h2 class="inline">&#9660; Import Default Tasks</h2>
      </button>
    </div>

    <!-- Step 5 - Edit Frequency, Delete Unwanted, Add Additional -->
    <div id="Step5" class="section inline">
      <button onclick="clickExpandBtn('editTasks')">
        <h2 class="inline">&#9660; Edit Tasks</h2>
      </button>
    </div>

  </main>
<?php include(SHARED_PATH . '/footer.php') ?>

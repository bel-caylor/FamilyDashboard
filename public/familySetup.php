<?php require_once('../private/initialize.php'); ?>

<?php
  //Session Parimeters
  $stepID = $_SESSION['step'] ?? $_POST['step'] ?? '1';
  // $stepID = substr($stepID,0,1) ?? '1';
  $header = 'Welcome to Family Dashboard';
  $familyID = $_SESSION['familyID'] ?? $_POST['familyID'] ?? '';
  $family = $_SESSION['family'] ?? $_POST['family'] ?? '';
  $postalCode = $_SESSION['postalCode'] ?? '';

  //NEED TO ADD ERROR HANDLING!!!
  // echo $stepID;
  // echo $_SERVER['REQUEST_METHOD'];

 ?>

 <?php include(SHARED_PATH . '/header.php') ?>

<body>
  <header>
    <?php echo $header ?>
  </header>

  <main>
<!-- Step 1 - Create/Edit Family  -->
    <div class="section inline">
      <button onclick="clickExpandBtn('Step1')">
        <h2 id="head1" class="inline">&#9660;
          <?php if ($stepID == '1') {echo "Create Family";}else {echo "Edit Family";}?>
        </h2>
      </button>
    </div>

    <!-- CREATE Family Form -->
    <!-- Hide section if moving onto Step 2. -->
    <div id="Step1" class="form">
      <form action="<?php echo WWW_ROOT?>/familySetup/1family.php" method="POST">
        <fieldset>
          <label  for="family" class="tooltip"><span class="tooltiptext">Last name</span>Family Name:  </label>
          <input type="text" id="family" name="family" value="<?php echo $family ?>" maxlength="10" size="10" pattern="[A-Za-z]{2,10}" title="Must be 2-10 letters." required><br>
          <label for="postalCode" class="tooltip"><span class="tooltiptext">ZIP Code</span>Postal Code:  </label>
          <input type="text" id="postalCode" name="postalCode" value="<?php echo $postalCode?>" maxlength="10" size="10" required><br>
          <input type="submit" <?php if ($stepID == '1') {echo 'value="Submit">';} else {echo 'value="Save Changes">';}?>
        </fieldset>
      </form>
    </div>

    <!-- Step 2 - Add Family Members -->
    <div id="Step2" class="section inline">
      <button onclick="clickExpandBtn('addUsers')">
        <h2 class="inline">&#9660; Add/Edit Family Members</h2>
      </button>
    </div>
    <div id="Step2" class="form <?php if ($stepID !== 2 && $updateMsg == '') {echo "hidden";}?>">
      <?php
      //UPDATE Message
      if ($updateMsg != "") {echo "<div class=message>" . $updateMsg . "</div>";}
      //CREATE Family Form
      $html = '<form action="' . WWW_ROOT . '/familySetup.php" method="POST">';
      $html .= '<label for="family">Name:  </label>';
      $html .= '<input type="text" id="name" name="name" value="'  . $Name .  '" maxlength="10" size="10"  pattern="[A-Za-z]{2-10}" required><br>';
      $html .= '<label  class="tooltip" for="Initial"><span class="tooltiptext">Unique for each family member</span>Initial:&nbsp;&nbsp;</label>';
      $html .= '<input type="text" id="Initial" name="Initial" value="'  . $Initial .  '" maxlength="1" size="1" required>';
      // $html .= '(unique for each family member)<br>';
      $html .= '<label for="postalCode"> &nbsp;&nbsp;&nbsp;&nbsp;Admin:  </label>';
      $html .= '<input type="checkbox" id="Admin" name="Admin" value="'  . $Admin .  '"><br>';
      $html .= '<input type="submit" ';
      if ($Name === "") {
        $html .= 'value="Add">';
      }else{
        $html .= 'value="Save Changes">';
        }
      $html .= '</form>';
      echo $html;
      ?>
    </div>

    <!-- Step 3 - Add Rooms/Categories  -->
    <div id="Step3" class="section inline">
      <button onclick="clickExpandBtn('addCategories')">
        <h2 class="inline">&#9660; Add Rooms/Categories</h2>
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

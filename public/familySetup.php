<?php require_once('../private/initialize.php'); ?>

<?php
  //Session Parimeters
  $stepID = $_COOKIE['step'] ?? $_POST['step'] ?? '1';
  // $stepID = substr($stepID,0,1) ?? '1';
  $header = 'Welcome to Family Dashboard';
  $familyID = $_COOKIE['familyID'] ?? $_POST['familyID'] ?? '';
  $family = $_COOKIE['family'] ?? $_POST['family'] ?? '';
  $postalCode = $_POST['postalCode'] ?? '';
  $updateMsg = '';
  $expires = time() + 60*60*24*14; //expires in 2 weeks


  //NEED TO ADD ERROR HANDLING!!!
  // echo $stepID;
  // echo $_SERVER['REQUEST_METHOD'];

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($stepID) {

      case 1:  //CREATE or EDIT Family
        $result = sqlCreateFamily(h($_POST['family']), h($_POST['postalCode']), $familyID);
        //Check for errors
        if (is_array($result)) {
          var_dump($result);
          break;
        //Check for Update
        } elseif ($result === "Family Updated"){
          $updateMsg = $result;
        } else {
        //Return familyID after Create
          setcookie('familyID', $familyID, $expires);
          setcookie('family', $_POST['family'], $expires);
          $familyID = $result;
        }
        setcookie('step', 2, $expires);
        $header = $familyName . ' Dashboard ';
        break;

      case 2:  //CREATE or EDIT Family Members

      case 3:  //CREATE or EDIT Rooms or Categories

      case 4:  //Import Default Tasks

      case 5:  //CREATE or EDIT Tasks
    }
  }
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
          <?php if ($familyID == '') {echo "Create Family";}else {echo "Edit Family";}?>
        </h2>
      </button>
    </div>

    <!-- CREATE Family Form -->
    <!-- Hide section if moving onto Step 2. -->
    <div id="Step1" class="form">
      <form action="<?php echo WWW_ROOT?>/familySetup/1family.php" method="POST">
        <fieldset>
          <label  for="family" class="tooltip"><span class="tooltiptext">Last name</span>Family Name:  </label>
          <input type="text" id="family" name="family" value="<?php echo $family ?>" maxlength="10" size="10"  pattern="[A-Za-z]{2-10}" required><br>
          <label for="postalCode" class="tooltip"><span class="tooltiptext">ZIP Code</span>Postal Code:  </label>
          <input type="text" id="postalCode" name="postalCode" value="<?php echo $postalCode?>" maxlength="10" size="10" required><br>
          <input type="hidden" name="step" value="1">
          <input type="hidden" name="familyID" value="<?php echo $familyID?>">
          <input type="submit" <?php if ($familyID == "") {echo 'value="Submit">';} else {echo 'value="Save Changes">';}?>
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

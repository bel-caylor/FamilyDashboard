<?php require_once('../private/initialize.php'); ?>
<?php require_once('../private/shared/sectionCreateFamily.php'); ?>

<?php
  //Session Parimeters
  $stepID = $_POST['step'] ?? '1';
  $stepID = substr($stepID,0,1) ?? '1';
  $header = 'Welcome to Family Dashboard';
  $familyID = $_COOKIE['familyID'] ?? $_POST['familyID'] ?? '';
  $familyName = $_COOKIE['family'] ?? $_POST['family'] ?? '';
  $postalCode = $_POST['postalCode'] ?? '';
  $updateMsg = '';
  $expires = time() + 60*60*24*14; //expires in 2 weeks


  //NEED TO ADD ERROR HANDLING!!!
  // echo $stepID;
  // echo $_SERVER['REQUEST_METHOD'];

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($stepID) {
      case 1:
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
        $stepID = '2';
        $header = $familyName . ' Dashboard ';
        break;
      case 2:

      case 3:

      case 4:

      case 5:
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
        <img class="btn inline <?php if ($stepID == 1) {echo "arrowUp";}?>" src="images/button-expand.png">
        <h2 class="inline">
          <?php if ($stepID == 1) {echo "Create Family";}else {echo "Edit Family";}?>
        </h2>
      </button>
    </div>
    <!-- Hide section if moving onto Step 2. -->
    <div id="Step1" class="form <?php if ($stepID == 2 && $updateMsg == '') {echo "hidden";}?>">
      <?php
      //UPDATE Message
      if ($updateMsg != "") {echo "<div class=message>" . $updateMsg . "</div>";}
      //CREATE Family Form
      echo createFamily($stepID, $familyName, $postalCode, $familyID);
      ?>
    </div>

    <!-- Step 2 - Add Family Members -->
    <div id="Step2" class="section inline">
      <button onclick="clickExpandBtn('addUsers')">
        <img class="btn inline" src="images/button-expand.png">
        <h2 class="inline">Add Family Members</h2>
      </button>
    </div>

    <!-- Step 3 - Add Rooms/Categories  -->
    <div id="Step3" class="section inline">
      <button onclick="clickExpandBtn('addCategories')">
        <img class="btn inline" src="images/button-expand.png">
        <h2 class="inline">Add Rooms/Categories</h2>
      </button>
    </div>

    <!-- Step 4 - Import Default Tasks  -->
    <div id="Step4" class="section inline">
      <button onclick="clickExpandBtn('importDftTasks')">
        <img class="btn inline" src="images/button-expand.png">
        <h2 class="inline">Import Default Tasks</h2>
      </button>
    </div>

    <!-- Step 5 - Edit Frequency, Delete Unwanted, Add Additional -->
    <div id="Step5" class="section inline">
      <button onclick="clickExpandBtn('editTasks')">
        <img class="btn inline" src="images/button-expand.png">
        <h2 class="inline">Edit Tasks</h2>
      </button>
    </div>

  </main>
<?php include(SHARED_PATH . '/footer.php') ?>

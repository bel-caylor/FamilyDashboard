<?php require_once('../private/initialize.php'); ?>

<?php
  //Session Parimeters
  $stepID = $_POST['step'] ?? '1';
  $stepID = substr($stepID,0,1) ?? '1';


  //NEED TO ADD ERROR HANDLING!!!
  // echo $stepID;
  // echo $_SERVER['REQUEST_METHOD'];

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($stepID) {
      case 1:
        $familyName = $_POST['family'];
        $familyID = createFamily($_POST['family'], $_POST['postalCode']);
        echo $familyID;
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
    Welcome to Family Dashboard
  </header>

  <main>
<!-- Step 1 - Create/Edit Family  -->
    <div id="Step1" class="section inline">
      <button onclick="clickExpandBtn('editFamily')">
        <img class="btn inline" src="images/button-expand.png">
        <h2 class="inline">
          <?php
            if ($stepID == 1) {echo "Create Family";}
            else {echo "Edit Family";}
           ?>

        </h2>
      </button>
    </div>
    <div id="createFamily" class="form">
      <?php include(SHARED_PATH . '/sectionCreateFamily.php'); ?>
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

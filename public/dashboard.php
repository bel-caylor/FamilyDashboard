<?php require_once('../private/initialize.php'); ?>

<!-- Check for login -->
<?php
  if ($_SESSION['currentUserID'] === '') {
    header("Location: " . WWW_ROOT . "/login.php");
  }

  //Create users array
  $_SESSION['users'] = [];
  $results = sqlSelect("family-members", "ID", "ASC", "Family_ID", $_SESSION['familyID']);
  while($row = mysqli_fetch_assoc($results)) {
    $_SESSION['users'][$row['ID']] = $row;
  };
?>

<?php include(SHARED_PATH . '/header.php') ?>
<body>
  <header>
      <?php echo $_SESSION['currentName'] . "`s Dashboard<br>";?>
  </header>

  <main>
    <br><br><br>
<!-- Challenge Report Section -->
    <!-- <div class="section inline">
      <button onclick="clickExpandBtn('reports')">
        <h2 id="reports" class="inline">&#9660; Challenge Reports</h2>
      </button>
    </div> -->

<!-- Complete Task Section -->
    <div class="section inline">
      <button onclick="clickDashboardSection('completeTasks')">
        <h2 id="reports" class="inline">&#9660; Complete Tasks</h2>
      </button>
    </div>
    <div id="completeTasks" class="">
      <div id="assigedChart">
        <?php include(PUBLIC_PATH . '/dashboard/2sumComplete.php') ?>
      </div>
      <?php include(PUBLIC_PATH . '\dashboard\2tblCompleteTasks.php') ?>
    </div>

<!-- Admintration Access -->
<?php if ($_SESSION['admin'] == 1) {?>
  <!-- Admin Grade Task Section -->
      <!-- <div class="section inline">
        <button onclick="clickExpandBtn('gradeTasks')">
          <h2 id="reports" class="inline">&#9660; Grade Tasks</h2>
        </button>
      </div> -->

  <!-- Admin Assign Task Section -->
      <div class="section inline">
        <button onclick="clickDashboardSection('assignTasks')">
          <h2 id="reports" class="inline">&#9660; Assign Tasks</h2>
        </button>
      </div>

      <div id="assignTasks" class="hidden">
        <div id="assigedChart">
          <?php include(PUBLIC_PATH . '/familySetup/5sumAssign.php') ?>
        </div>
        <?php include(PUBLIC_PATH . '\dashboard\4tblAssign.php') ?>
      </div>

  <!-- Go to familySetup -->
      <div class="section inline <?php if ($_SESSION['admin'] == 0) {echo "hidden";} ?>">
        <button onclick="window.location='familySetup.php'">
          <h2 id="reports" class="inline">&#9660; Setup Tasks & Users</h2>
        </button>
      </div>

<?php } ?>

</section>


  </main>
<?php include(SHARED_PATH . '/footer.php') ?>

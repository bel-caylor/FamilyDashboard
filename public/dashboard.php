<?php require_once('../private/initialize.php'); ?>

<?php ?>

<?php include(SHARED_PATH . '/header.php') ?>
<body>
  <header>
      <?php echo $_SESSION['currentName'] . "`s Dashboard<br>";?>
  </header>

  <main>
    <br>
<!-- Challenge Report Section -->
    <div class="section inline">
      <button onclick="clickExpandBtn('reports')">
        <h2 id="reports" class="inline">&#9660; Challenge Reports</h2>
      </button>
    </div>

<!-- Complete Task Section -->
    <div class="section inline">
      <button onclick="clickExpandBtn('completeTasks')">
        <h2 id="reports" class="inline">&#9660; Complete Tasks</h2>
      </button>
    </div>
    <?php include(PUBLIC_PATH . '\dashboard\2tblCompleteTasks.php') ?>


<!-- Admin Grade Task Section -->
    <div class="section inline">
      <button onclick="clickExpandBtn('gradeTasks')">
        <h2 id="reports" class="inline">&#9660; Grade Tasks</h2>
      </button>
    </div>

<!-- Admin Assign Task Section -->
    <div class="section inline">
      <button onclick="clickExpandBtn('assignTasks')">
        <h2 id="reports" class="inline">&#9660; Assign Tasks</h2>
      </button>
    </div>

<!-- Go to familySetup -->
    <div class="section inline">
      <button onclick="clickExpandBtn('familySetup')">
        <h2 id="reports" class="inline">&#9660; Add/Remove Tasks, Categories, Users</h2>
      </button>
    </div>

</section>


  </main>
<?php include(SHARED_PATH . '/footer.php') ?>

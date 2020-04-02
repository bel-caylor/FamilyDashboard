<?php require_once('../private/initialize.php');
require_once(SHARED_PATH . '/optionUsers.php');
 ?>

<?php
  //Session Parimeters
  $familyID = 1;

  //SQL for page setup
  $defaultTasks = query_Select("default_tasks", "Category_ID");
  // $familyTasks = query_familyTasks($familyID);
 ?>

 <?php include(SHARED_PATH . '/header.php') ?>

<body>
  <header>
    Family Dashboard
  </header>

  <main>
    <!-- Messages -->

    <!-- House Tasks -->

    <!-- Personal Tasks -->

    <!-- Create & Assign Tasks -->
    <div class="section inline">
      <button onclick="clickExpandBtn('assignTask')">
        <img class="btn inline" src="images/button-expand.png">
        <h2 class="inline">Assign Tasks</h2>
      </button>
    </div>
    <div id="assignTask">
      <?php include(SHARED_PATH . '/sectionAssignTask.php'); ?>
    </div>


    <!-- Create Tasks -->

  </main>
<?php include(SHARED_PATH . '/footer.php') ?>

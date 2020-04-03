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
    <!-- Reports -->
      <!-- Daily Completed Minutes -->
      <!-- 7-Day Completed Minutes -->
      <!-- Family Meter - with colors users and bar representing % of task. -->
      <!-- Idea for Completion change background color from red - yellow - blue based on % complete -->

    <!-- House Tasks -->
      <!-- Assigned Tasks  -->
      <!-- Available Tasks -->

    <!-- Personal Tasks -->

    <!-- Meal Plan -->

    <!-- Assign Tasks -->
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
    <div class="section inline">
      <button onclick="clickExpandBtn('createTask')">
        <img class="btn inline" src="images/button-expand.png">
        <h2 class="inline">Create Tasks</h2>
      </button>
    </div>
    <div id="assignTask">
      <?php include(SHARED_PATH . '/sectionCreateTask.php'); ?>
    </div>

    <!-- Create Categories -->
    <!-- NEED A REDIRECT -->
        <!-- <div class="section inline">
          <button onclick="clickExpandBtn('createCategories')">
            <img class="btn inline" src="images/button-expand.png">
            <h2 class="inline">Create Categories & Tasks</h2>
          </button>
        </div>
        <div id="assignTask">
          <?php //include(SHARED_PATH . '/sectionCreateCategory.php'); ?>
        </div> -->


  </main>
<?php include(SHARED_PATH . '/footer.php') ?>

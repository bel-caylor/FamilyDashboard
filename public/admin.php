<?php require_once('../private/initialize.php'); ?>

<?php
  //Session Parimeters
  $familyID = 1;

  //SQL for page setup
  $defaultTasks = query_Select("default_tasks", "Category_ID");
  // $familyTasks = query_familyTasks($familyID);
 ?>

 <?php include(SHARED_PATH . '/header.php') ?>

<body>

  <main>
    <!-- Messages -->

    <!-- House Tasks -->

    <!-- Personal Tasks -->

    <!-- Create & Assign Tasks -->
    <?php
      include(SHARED_PATH . '/sectionCategory.php');
      include(SHARED_PATH . '/optionsFreq.php');
      include(SHARED_PATH . '/optionsType.php');
    ?>

    <!-- Edit & Create Categories -->

  </main>

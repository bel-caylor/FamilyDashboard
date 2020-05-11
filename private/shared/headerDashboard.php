<?php
  if(!isset($page_title)) {$page_title = 'Family Dashboard';}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title><?php echo $page_title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=350, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo WWW_ROOT?>/stylesheets/css/main.css">
    <script src="https://kit.fontawesome.com/b95b14ad08.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
  </head>

  <body onload="onLoad()">
    <header>
      <div class="navHover">
        <button onclick="toggleNav()"><i class="fas fa-bars"></i>
          <div id="navContent" class="hidden">
            <a href="#Step2">Complete Tasks</a><br>
            <a href="#Step3">Grade Tasks</a><br>
            <a href="#Step4">Assign Tasks</a><br>
            <a href="familySetup.php#Step4">Setup Users & Tasks</a><br>
            <a href="logout.php">Log Out</a><br>
          </div>
      </div>

      <div>
        <?php echo "&nbsp;&nbsp;&nbsp;" . $header . "<button class='tooltip' onclick=\"window.location='dashboard.php'\"><span class='tooltiptext'>Refresh Page</span><i class='fas fa-redo-alt'></i>";?>
        <?php echo "&nbsp;&nbsp;&nbsp;" . $header;?>
      </div>
    </header>

    <main>

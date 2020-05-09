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
            <a href="#Step1">Edit Family</a><br>
            <a href="#Step2">Add Users</a><br>
            <a href="#Step3">Edit Users</a><br>
            <a href="#Step4">Add Room Tasks</a><br>
            <a href="#Step6">Add Custom Tasks</a><br>
            <a href="#Step5">Edit Tasks</a><br>
            <a href="dashboar.php">Go To <?php echo $_SESSION['currentName'] ?>'s Dashboard</a><br>
          </div>
      </div>

      <div>
        <?php echo "&nbsp;&nbsp;&nbsp;" . $header;?>
      </div>
    </header>

    <main>

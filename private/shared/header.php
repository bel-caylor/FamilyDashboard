<?php
  if(!isset($page_title)) {$page_title = 'Family Dashboard';}
  if(!isset($header)) {$header = "Family Dashboard Login";}
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

<?php if($header != "Family Dashboard Login") { ?>
  <body onload="onLoad()">
<?php } else { ?>
  <body">
<?php } ?>
    <header>
      <?php if($_SESSION['step'] >3) { ?>
        <div class="navHover">
          <button onclick="toggleNav()"><i class="fas fa-bars"></i>
            <div id="navContent" class="hidden">
              <a href="#Step1">Edit Family</a><br>
              <a href="#Step2">Add Users</a><br>
              <a href="#Step3">Edit Users</a><br>
              <a href="#Step4">Add Room Tasks</a><br>
              <a href="#Step6">Add Custom Tasks</a><br>
              <a href="#Step5">Edit Tasks</a><br>
              <a href="dashboard.php">Go To <?php echo $_SESSION['currentName'] ?>'s Dashboard</a><br>
              <a href="logout.php">Log Out</a><br>
            </div>
        </div>
      <?php } ?>
      <div>
        <?php
          $html = "&nbsp;&nbsp;&nbsp;" . $header;
          if ($header != "Family Dashboard Login") {
            $html .= "<button class='tooltip' onclick=\"window.location='familySetup.php'\">";
            $html .= "<span class='tooltiptext'>Refresh Page</span><i class='fas fa-redo-alt'></i>";
          }
          echo $html;
        ?>
      </div>
    </header>

    <main>

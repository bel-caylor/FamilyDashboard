<?php require_once('../../private/initialize.php');

$userSumAssign = sqlSumAssignTime();
$aryAssignTotal = sqlSumTotalAssign();
$assignTotal = mysqli_fetch_assoc($aryAssignTotal)['SUM(Time)']
// $users = sqlUsers($_SESSION['familyID']);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    //Setup CSS for Users
    <meta name="viewport" content="width=350, initial-scale=1">
      <style>
        .chart {
          width: 80%;
          padding: 10px;
          mar
        }

        .user {
          display: inline-block;
          text-align: center;
          padding: 0;
          margin-right: -4px;
        }
        <?php
          while($row = mysqli_fetch_assoc($userSumAssign)) {
            $html = ".user" . $row['Assigned_User_ID'] . " {";
            $html .= "background-color: " . $row['Color'] . ";";
            $percentTime = (int)((($row['SUM(Time)'] / $assignTotal) * 100)-1);
            $html .= "width: " . $percentTime . "%;";
            $html .= "}  ";
            echo $html;
          }
        ?>
      </style>
  </head>

  <?php $userSumAssign = sqlSumAssignTime(); ?>
  <body>

    <div class="chart">
      <?php
        while($row = mysqli_fetch_assoc($userSumAssign)) {?>
          <div class="user user<?php echo $row['Assigned_User_ID'] ?>">
            <?php echo $row['Initial'] ?>
          </div>

      <?php }?>
    </div>


    <!-- UserSum =
    <?php print_r($userSumAssign) . "<br>"?>
    Total =
    <?php print_r($aryAssignTotal) . "<br>"?>
    <?php echo $assignTotal ?> -->
  </body>

</html>

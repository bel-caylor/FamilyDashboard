<?php

$userSumAssign = sqlSumAssignTime();
$aryAssignTotal = sqlSumTotalAssign();
$assignTotal = mysqli_fetch_assoc($aryAssignTotal)['SUM(Time)']
// $users = sqlUsers($_SESSION['familyID']);
?>
      <style>
        .chart {
          width: 93%;
          /* padding: 0 10px 0px 0px; */

        }

        .user {
          display: inline-block;
          text-align: center;
          padding: 0;
          font-weight: bold;
          color: white;
          padding: 3px 0 3px 0;
          margin-right: -5px;
          /* font-weight: bold; */
        }

        .blank {
          width: 2%;
        }
        <?php
          while($row = mysqli_fetch_assoc($userSumAssign)) {
            $html = ".user" . $row['Assigned_User_ID'] . " {";
            $html .= "background-color: " . $row['Color'] . ";";
            $percentTime = (int)((($row['SUM(Time)'] / $assignTotal) * 100));
            $html .= "width: " . $percentTime . "%;";
            $html .= "}  ";
            echo $html;
          }
        ?>
      </style>

  <?php $userSumAssign = sqlSumAssignTime(); ?>
  <body>

    <div class="chart">
      <h3>User Percent Time of Assigned</h3>
      <div class="">
        <?php
          while($row = mysqli_fetch_assoc($userSumAssign)) {?>
            <div class="user user<?php echo $row['Assigned_User_ID'] ?>">
              <?php $percentTime = (int)((($row['SUM(Time)'] / $assignTotal) * 100)-1); ?>
              <?php echo $row['Initial'] . "<br>" . $percentTime . "%" ?>
            </div>

        <?php }?>
      </div>
    </div>

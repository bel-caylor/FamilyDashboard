<?php

$userSumAssign = sqlSumAssignTime();
$aryAssignTotal = sqlSumTotalAssign();
$assignTotal = mysqli_fetch_assoc($aryAssignTotal)['SUM(Time)']
// $users = sqlUsers($_SESSION['familyID']);
?>
      <style>
        .chart {
          width: 100%;
          /* padding: 0 10px 0px 0px; */

        }

        .user {
          display: inline-block;
          text-align: center;
          padding: 0;
          margin-right: -4px;
          /* font-weight: bold; */
        }

        .blank {
          width: 2%;
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

  <?php $userSumAssign = sqlSumAssignTime(); ?>
  <body>

    <div class="chart">
      <h3>User Percent Time of Assigned</h3>
      <div class="user blank">

      </div>
      <?php
        while($row = mysqli_fetch_assoc($userSumAssign)) {?>
          <div class="user user<?php echo $row['Assigned_User_ID'] ?>">
            <?php $percentTime = (int)((($row['SUM(Time)'] / $assignTotal) * 100)-1); ?>
            <?php echo $row['Initial'] . "-" . $percentTime . "%" ?>
          </div>

      <?php }?>
    </div>

</html>

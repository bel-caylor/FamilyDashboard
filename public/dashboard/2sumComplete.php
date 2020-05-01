
<?php
$userSumComplete = sqlSumCompleteByUser();
$aryTotalComplete = sqlSumTotalComplete();
$completeTotal = mysqli_fetch_assoc($aryTotalComplete)['SUM(Time)']
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
          while($row = mysqli_fetch_assoc($userSumComplete)) {
            $html = ".user" . $row['User_ID'] . " {";
            $html .= "background-color: " . $row['Color'] . ";";
            $percentTime = (int)((($row['SUM(Time)'] / $completeTotal) * 100)-1);
            $html .= "width: " . $percentTime . "%;";
            $html .= "}  ";
            echo $html;
          }
        ?>
      </style>

  <?php $userSumComplete = sqlSumCompleteByUser(); ?>
  <body>

    <div class="chart">
      <h3>User Percent Time of Complete</h3>
      <div class="user blank">

      </div>
      <?php
        while($row = mysqli_fetch_assoc($userSumComplete)) {?>
          <div class="user user<?php echo $row['User_ID'] ?>">
            <?php $percentTime = (int)((($row['SUM(Time)'] / $completeTotal) * 100)-1); ?>
            <?php echo $row['Initial'] . "-" . $percentTime . "%" ?>
          </div>

      <?php }?>
    </div>

</html>

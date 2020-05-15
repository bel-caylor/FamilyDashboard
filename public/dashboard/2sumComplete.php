
<?php
  // Check for login
  if ($_SESSION['currentUserID'] === '') {
    header("Location: " . WWW_ROOT . "/login.php");
  }
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
          $html = "";
          while($row = mysqli_fetch_assoc($userSumComplete)) {
            $html .= ".userComplete" . $row['User_ID'] . " {";
            $html .= "background-color: " . $row['Color'] . ";";
            $percentTime = (int)((($row['SUM(Time)'] / $completeTotal) * 100));
            $html .= "width: " . $percentTime . "%;";
            $html .= "}  ";
          }
        echo $html;
        ?>
      </style>

  <?php $userSumComplete = sqlSumCompleteByUser(); ?>
  <body>

    <div class="chart">
      <h3>User Percent Time of Complete <?php echo $completeTotal ?></h3>
      <div class="user blank">

      </div>
      <?php
        while($row = mysqli_fetch_assoc($userSumComplete)) {?>
          <div class="user userComplete<?php echo $row['User_ID'] ?>">
            <?php $percentTime = (int)((($row['SUM(Time)'] / $completeTotal) * 100)); ?>
            <?php echo $row['Initial'] . "<br>" . $percentTime . "%" ?>
          </div>

      <?php }?>
    </div>

</html>

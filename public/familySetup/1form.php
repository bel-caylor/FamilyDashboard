<div id="Step1" class="form">
  <form id="form1" action="<?php echo WWW_ROOT?>/familySetup/1family.php" method="POST">
    <fieldset>
      <label  for="family">Family Name:  </label>
      <input type="text" id="family" name="family" value="<?php echo  $_SESSION['family'] ?>" maxlength="10" size="10" pattern="[A-Za-z]{2,10}" title="Must be 2-10 letters." required><br>
      <label for="postalCode">Postal Code:  </label>
      <input type="text" id="postalCode" name="postalCode" value="<?php echo $_SESSION['postalCode']?>" maxlength="10" size="10" required><br>
      <p role="alert" class="status-failure" hidden>Connection failure, please try again.</p>
      <p role="alert" class="status-busy" hidden>Busy sending data, please wait.</p>
      <p role="alert" class="status-message" <?php if ($_SESSION['step1Msgs'] == []) {echo "hidden";} ?>>
        <?php if ($_SESSION['step1Msgs'] !== []) {echo echoMsgArray($_SESSION['step1Msgs']);} ?></p>
      <input id="btn1" type="submit" <?php if ($_SESSION['step'] == '1') {echo 'value="Submit">';} else {echo 'value="Save Changes">';}?>
      <input type="hidden" id="step" value="Step2">
    </fieldset>
  </form>
</div>

<?php  //Form Values
  $name = $_SESSION['aryUser']['name'] ?? '';
  $initial = $_SESSION['aryUser']['initial'] ?? '';
  $color = $_SESSION['aryUser']['color'] ?? '';
  $email = $_SESSION['aryUser']['email'] ?? $_SESSION['email'] ?? '';
  $admin = $_SESSION['aryUser']['admin'] ?? '';
 ?>
<div class="form">
  <form id="form2" action="<?php echo WWW_ROOT?>/familySetup/2addUser.php" method="POST">
    <fieldset>
      <!-- <label for="name">Name:  </label> -->
      <input type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="User Name" maxlength="10" size="10" pattern="[A-Za-z]{2,10}" title="Must be 2-10 letters." required>&nbsp;&nbsp;
      <label for="initial">Initial:
      <input type="text" id="initial" name="initial" value="<?php echo $initial; ?>" maxlength="2" size="1" required></label><br>
      <label for="color">Color:
      <input type="color" id="color" name="color" value="<?php echo setValue($color, "#337AFF"); ?>"></label>
      <label for="admin"> &nbsp;&nbsp;&nbsp;&nbsp;Admin:
      <input type="checkbox" id="admin" name="admin" value="<?php echo setValue($admin, "1"); ?>" checked></label><br>
      <label for="email">Email:  </label>
      <input type="text" id="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>"maxlength="255" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter valide email." required><br>
      <div id="pwds"<?php if ($_SESSION['currentUserID'] !== '') {echo " hidden";}?>>
        <label for="password">Password:  </label>
        <input type="button" value="View passwords" onclick="togglePwdVisible()"><br>
        <input type="password" id="password1" name="password1" placeholder="Create password" maxlength="10" size="15" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" <?php if ($_SESSION['currentUserID'] == '') {echo " required";}?>>&nbsp;&nbsp;
        <input type="password" id="password2" name="password2" placeholder="Re-type password" maxlength="255" size="15" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" <?php if ($_SESSION['currentUserID'] == '') {echo " required";}?>><br>
        Must be 8 to 10 characters long and contain at least one number and one uppercase and lowercase letter.<br>
      </div>
      <p role="alert" class="status-failure" hidden>Connection failure, please try again.</p>
      <p role="alert" class="status-busy" hidden>Busy sending data, please wait.</p>
      <p role="alert" id="step2Msgs" class="status-message"><?php echo echoMsgArray($_SESSION['step2Msgs']); ?></p>
      <input type="hidden" id="step" value="Step2">
      <input type="submit" value="Add">
    </fieldset>
  </form>
</div>

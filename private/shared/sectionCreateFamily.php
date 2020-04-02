<form action="<?php echo WWW_ROOT ?>/familySetup.php" method="POST">
  <label for="family">Family Name:</label>
  <input type="text" id="family" name="family" maxlength="10" size="10" required><br>
  <label for="postalCode">Postal/Zip Code:</label>
  <input type="text" id="postalCode" name="postalCode" maxlength="10" size="10" required><br>
  <input type="hidden" id="step" value="1">
  <input type="submit" value="Submit">
</form>

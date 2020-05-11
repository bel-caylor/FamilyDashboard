<div id="contentStep6">
  <p role="alert" id="step6Msgs" class="status-message"><?php if ($_SESSION['step6Msgs'] !== []) {echo echoMsgArray($_SESSION['step6Msgs']);} ?></p>
    <form id="form6" action="<?php echo WWW_ROOT?>/familySetup/6addTask.php" method="POST">
      <input type="hidden" id="step" value="Step5">
      <fieldset>
        <table class="formTable">
      <!-- Category Type -->
          <tr>
            <th class="formLabel">Category Name:</th>
            <th class="formInput"><?php include(PRIVATE_PATH . '/shared/optionsCatName.php') ?></th>
          </tr>
      <!-- Category Name -->
          <tr id="newCat">
            <th class="formLabel">NEW Category Name:</th>
            <th class="formInput"><input type="text" id="catName2" name="catName2" placeholder="description" maxlength="20" size="10" required></th>
          </tr>
      <!-- Type -->
          <tr id="typeRow">
            <th class="formLabel">Type:</th>
            <th class="formInput"><?php include(PRIVATE_PATH . '/shared/optionsType.php') ?></th>
          </tr>
      <!-- UserID -->
          <tr id="typeRow">
            <th class="formLabel">Always Assigned to:</th>
            <th class="formInput"><?php echo optionUsers(); ?></th>
          </tr>
    <!-- Description -->
          <tr>
            <th class="formLabel">Task:</th>
            <th class="formInput"><input type="text" id="taskDesc" name="taskDesc" placeholder="description" maxlength="30" size="10" required></th>
          </tr>
    <!-- Frequency -->
          <tr>
            <th class="formLabel">Frequency:</th>
            <th class="formInput"><?php echo optionFreq(); ?></th>
          </tr>
    <!-- Start -->
          <tr class="formInput">
            <th class="formLabel">Start:</th>
            <th class="formInput"><input id="start" name="start" type="date" size="4" class="name"></th>
          </tr>
    <!-- Time Estimate -->
          <tr>
            <th class="formLabel tooltip"><span class="tooltiptext">Minutes<br>to Complete</span>Time Estimate:</th>
            <th class="formInput"><input type="number" name="time" size="2" class="name" min="1" max="200" value="1"></th>
          </tr>
    <!-- Note -->
          <tr>
            <th class="formInput" colspan="2">
              <input type="text" name="note" size="40" placeholder="Note"></th>
          </tr>
    <!-- Submit -->
          <tr>
            <p role="alert" class="status-failure" hidden>Connection failure, please try again.</p>
            <p role="alert" class="status-busy" hidden>Busy sending data, please wait.</p>
            <p role="alert" class="status-message" <?php if ($_SESSION['step6Msgs'] == []) {echo "hidden";} ?>>
            <th colspan="2"><input type="submit" value="Add Task"></th>
          </tr>
        </table>
      </fieldset>
    </form>
</div>

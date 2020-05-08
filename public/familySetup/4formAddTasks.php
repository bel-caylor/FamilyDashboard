<div id="addTasks">
  <div class="form">
    <form id="form4" action="<?php echo WWW_ROOT?>/familySetup/4addCategory.php" method="POST">
      <fieldset>
        <label for="name">Name:
        <input type="text" id="catName" name="catName" placeholder="e.g. Master Bedroom" maxlength="20" size="20" required></label><br>
        <label>Select room type to add default tasks.</label>
        <label for="category">Type:
        <?php include(PRIVATE_PATH . '/shared/optionsCategory.php') ?></label><br>
        <p role="alert" class="status-failure" hidden>Connection failure, please try again.</p>
        <p role="alert" class="status-busy" hidden>Busy sending data, please wait.</p>
        <p role="alert" id="step4Msgs" class="status-message"><?php echo echoMsgArray($_SESSION['step4Msgs']); ?></p>
        <input type="hidden" id="step" value="Step3">
        <input type="submit" value="ENTER">
      </fieldset>
    </form>
  </div>
</div>


<!-- Delete User Alert -->
<?php include(SHARED_PATH . '/alertPopUp.php') ?>
<p role="alert" class="status-failure" hidden>Connection failure, please try again.</p>
<p role="alert" class="status-busy" hidden>Busy sending data, please wait.</p>
<p role="alert" id="step3Msgs" class="status-message"><?php echo echoMsgArray($_SESSION['step4Msgs']); ?></p>

<div id="contentStep3">
  <table id="tblUsers" class="table"<?php if ($_SESSION['step'] !== '2' and $_SESSION['currentUserID'] == '') {echo " hidden";}?>>
    <!-- Column Names-->
      <tr>
        <th colspan="2">Name</th>
        <th>Color</th>
        <th id="EditSave">Edit</th>
        <th>Delete</th>
      </tr>
      <tr class="hidden">
        <th colspan="3">Email</th>
        <th colspan="1">Int</th>
        <th colspan="1">Adm</th>
      </tr>
    <?php $Users = $_SESSION['users'];?>
    <!-- User Rows -->
        <?php foreach(array_keys($Users) as $User) {?>
              <tr id="userID<?php echo $Users[$User]['ID'] ?>" class="tblRow">
                <th class="userID" hidden><?php echo $Users[$User]['ID'] ?></th>
                <th colspan="2"><input type="text" size="4" class="name trans" value="<?php echo $Users[$User]['Name'] ?>" disabled></th>
                <th colspan="1"><input type="color" class="trans color" value="<?php echo $Users[$User]['Color'] ?>" size="1" disabled></th>
                <th id="Edt<?php echo $Users[$User]['ID'] ?>"><button type="button" onclick="editUser(<?php echo $Users[$User]['ID'] ?>)"><i class="fas fa-pencil-alt"></i></th>
                <th><button type="button" onclick="clickDeleteUser(<?php echo $User ?>, <?php echo $Users[$User]['ID'] ?>, '<?php echo $Users[$User]['Name'] ?>')"><i class="far fa-trash-alt"></i></th>
              </tr>
                <tr id="Hdn<?php echo $Users[$User]['ID'] ?>" class="hidden">
                <th colspan="3" class="email"><input type="text" size="25" class="trans" value="<?php echo $Users[$User]['Email'] ?>"></th>
                <th class="initial tooltip"><span class="tooltiptext">Unique Initial</span>
                  <input type="text" size="1" class="trans" value="<?php echo $Users[$User]['Initial'] ?>"></th>
                <th colspan="1" class="admin tooltip"><span class="tooltiptext">Administrator</span>
                  <input type="checkbox" size="1" class="trans" <?php if ($Users[$User]['Admin'] == 1) {echo "checked";} ?>></th>
              </tr>
      <?php } ?>
    <!-- </div> -->
  </table>
</div>

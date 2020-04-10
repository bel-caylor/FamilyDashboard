


<table id="tblUsers" class="table"<?php if ($_SESSION['step'] !== '2' and $_SESSION['currentUserID'] == '') {echo " hidden";}?>>
  <!-- Column Names-->
    <tr>
      <th colspan="2">Name</th>
      <th class="tooltip"><span class="tooltiptext">Unique Color</span>Clr</th>
      <th id="EditSave" class="tooltip"><span class="tooltiptext">Edit User</span>Edt</th>
      <th class="tooltip"><span class="tooltiptext">Delete User</span>Dlt</th>
    </tr>
    <tr class="hidden">
      <th colspan="3">Email</th>
      <th class="tooltip" colspan="1"><span class="tooltiptext">Unique Initial</span>Int</th>
      <th class="tooltip" colspan="1"><span class="tooltiptext">Add/Assign/Grade Tasks</span>Adm</th>
    </tr>
  <?php $Users = $_SESSION['users'];?>
  <!-- User Rows -->
      <?php foreach(array_keys($Users) as $User) {?>
        <!-- <form id="form" action="<?php echo WWW_ROOT?>/familySetup/1family.php" method="POST"> -->
            <tr id="userID<?php echo $Users[$User]['ID'] ?>" class="tblRow">
              <th class="userID" hidden><?php echo $Users[$User]['ID'] ?></th>
              <th colspan="2"><input type="text" size="4" class="name trans" value="<?php echo $User ?>" disabled></th>
              <th colspan="1"><input type="color" class="trans color" value="<?php echo $Users[$User]['Color'] ?>" size="1" disabled></th>
              <th id="Edt<?php echo $Users[$User]['ID'] ?>"><button type="button" onclick="editUser(<?php echo $Users[$User]['ID'] ?>)">&#128393;</button></th>
              <th><button type="button" onclick="myFunction()">&#128465;</button></th>
            </tr>
              <tr id="Hdn<?php echo $Users[$User]['ID'] ?>" class="hidden">
              <th colspan="3" class="email"><input type="text" size="15" class="trans" value="<?php echo $Users[$User]['Email'] ?>"></th>
              <th class="initial"><input type="text" size="1" class="trans" value="<?php echo $Users[$User]['Initial'] ?>"></th>
              <th colspan="1" class="admin"><input type="checkbox" size="1" class="trans" value="<?php echo $Users[$User]['Admin'] ?>" "<?php if ($Users[$User]['Admin'] == 1) {echo "checked";} ?>"></th>
            </tr>
        <!-- </form> -->
    <?php } ?>
  <!-- </div> -->
</table>

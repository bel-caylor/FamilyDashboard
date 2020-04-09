
 

<table id="tblUsers" class="table"<?php if ($_SESSION['step'] !== '2' and $_SESSION['currentUserID'] == '') {echo " hidden";}?>>
  <tr>
    <th>Name</th>
    <th>Intl</th>
    <th>Color</th>
    <th>Edt</th>
    <th>Dlt</th>
  </tr>
  <?php
  $Users = $_SESSION['users'];
  foreach(array_keys($Users) as $User) {?>
    <tr id="userID<?php $Users[$User]['ID'] ?> class="tblRow">
      <th class="userID" hidden><?php echo $Users[$User]['ID'] ?></th>
      <th class="name"><?php echo $User ?></th>
      <th class="initial"><?php echo $Users[$User]['Initial'] ?></th>
      <th class="color"><input type="color" value="<?php echo $Users[$User]['Color'] ?>" size="1" disabled></th>
      <div class="admin" hidden><?php echo $Users[$User]['Admin'] ?></th>
      <div class="email" hidden><?php echo $Users[$User]['Email'] ?></th>
      <th><button type="button" name="button">&#128393;</button></th>
      <th><button type="button" name="button">&#128465;</button></th>
    </tr>
  <?php } ?>
</table>

<?php

function section($id, $name) {?>
  <div id='<?php echo $id ?>' class="section">
      <button onclick="clickExpandBtn('Step1')">
        <h2 id="head1">&#9660; <?php echo $name ?></h2>
      </button>
    <div class="btnRight">
      <button type="button" onclick="toggleInfo('info<?php echo $id ?>')"><i class="fas fa-info-circle"></i>
    </div>
  </div>

<?php } ?>

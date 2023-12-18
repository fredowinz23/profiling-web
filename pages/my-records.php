<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

?>

<style media="screen">
  .editable{
    cursor: pointer;
  }
</style>


<div class="row">
  <div class="col">
    <div class="card editable" onclick="location.href='record-list.php?type=Lesson Plan'">
      <div class="card-body">
          <h3>Lesson Plans</h3>
      </div>
    </div>
  </div>
  <div class="col">
    <ul class="list-group">
      <li class="list-group-item"><h3>Forms</h3></li>
      <li class="list-group-item editable" onclick="location.href='record-list.php?type=SF1'">SF1</li>
      <li class="list-group-item editable" onclick="location.href='record-list.php?type=SF2'">SF2</li>
      <li class="list-group-item editable" onclick="location.href='record-list.php?type=SF3'">SF3</li>
      <li class="list-group-item editable" onclick="location.href='record-list.php?type=SF9'">SF9</li>
      <li class="list-group-item editable" onclick="location.href='record-list.php?type=SF10'">SF10</li>
    </ul>
  </div>
</div>


<?php include $ROOT_DIR . "templates/footer.php"; ?>

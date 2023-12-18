<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

  $facultyId = get_query_string("facultyId", "");
  if ($facultyId) {
    $account = account()->get("Id=$facultyId");
  }

?>



<h2>Faculty Profile</h2>

<?php if ($account->image!=""): ?>
  <img src="../media/<?=$account->image?>" style="width:200px">
<?php endif; ?>

<form action="process.php?action=profile-save" method="post">
<div class="row">
  <div class="col-6 mt-2">
    <input type="hidden" name="Id" value="<?=$account->Id?>">
    <b>First Name</b>
    <input type="text" name="firstName" value="<?=$account->firstName?>" class="form-control" disabled>
  </div>
  <div class="col-6 mt-2">
    <b>Last Name</b>
    <input type="text" name="lastName" value="<?=$account->lastName?>" class="form-control" disabled>
  </div>
  <div class="col-6 mt-2">
    <b>Birthday</b>
    <input type="date" name="birthday" value="<?=$account->birthday?>" class="form-control" disabled>
  </div>
  <div class="col-6 mt-2">
    <b>Birth Place</b>
    <input type="text" name="birthPlace" value="<?=$account->birthPlace?>" class="form-control" disabled>
  </div>

  <div class="col-4 mt-2">
    <b>Civil Status</b>
    <input type="text" name="civilStatus" value="<?=$account->civilStatus?>" class="form-control" disabled>
  </div>

  <div class="col-4 mt-2">
    <b>Gender</b>
    <input type="text" name="civilStatus" value="<?=$account->sex?>" class="form-control" disabled>
  </div>

  <div class="col-4 mt-2">
    <b>Religion</b>
    <input type="text" name="religion" value="<?=$account->religion?>" class="form-control" disabled>
  </div>
  <div class="col-6 mt-2">
    <b>Email</b>
    <input type="text" name="email" value="<?=$account->email?>" class="form-control" disabled>
  </div>
  <div class="col-6 mt-2">
    <b>Mobile Number</b>
    <input type="number" name="phone" value="<?=$account->phone?>" class="form-control" disabled>
  </div>
  <div class="col-12 mt-2">
    <b>Address</b>
    <textarea name="address" class="form-control" disabled><?=$account->address?></textarea>
  </div>
  <div class="col-12 mt-2">
    <b>Education Background</b>
    <textarea name="email" class="form-control" disabled><?=$account->educationalBackground?></textarea>
  </div>
  <div class="col-12 mt-2">
    <b>Teaching Experience</b>
    <textarea name="teachingExperience" class="form-control" disabled><?=$account->teachingExperience?></textarea>
  </div>


  <div class="col-4 mt-2">
    <b>SSS</b>
    <input type="text" name="ss" value="<?=$account->sss?>" class="form-control" disabled>
  </div>

  <div class="col-4 mt-2">
    <b>Phil Health</b>
    <input type="text" name="philHealth" value="<?=$account->philHealth?>" class="form-control" disabled>
  </div>

</div>

<?php if (!$facultyId): ?>

  <a href="my-profile-form.php" class="btn btn-warning mt-2">Modify</a>
<?php endif; ?>

</form>



<?php include $ROOT_DIR . "templates/footer.php"; ?>

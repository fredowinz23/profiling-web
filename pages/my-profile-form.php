<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";


?>


<h2>Teacher Profile Form</h2>

<form action="process.php?action=profile-save" enctype="multipart/form-data" method="post">
<div class="row">
  <div class="col-4 mt-2">
    <input type="hidden" name="Id" value="<?=$account->Id?>">
    <b>Upload Image</b>
    <input type="file" name="image" class="form-control">
  </div>
    <div class="col-4 mt-2">
      <input type="hidden" name="Id" value="<?=$account->Id?>">
      <b>First Name</b>
      <input type="text" name="firstName" value="<?=$account->firstName?>" class="form-control" required>
    </div>
  <div class="col-4 mt-2">
    <b>Last Name</b>
    <input type="text" name="lastName" value="<?=$account->lastName?>" class="form-control" required>
  </div>
  <div class="col-6 mt-2">
    <b>Birthday</b>
    <input type="date" name="birthday" value="<?=$account->birthday?>" class="form-control" required>
  </div>
  <div class="col-6 mt-2">
    <b>Birth Place</b>
    <input type="text" name="birthPlace" value="<?=$account->birthPlace?>" class="form-control" required>
  </div>

  <div class="col-4 mt-2">
    <b>Civil Status</b>
    <input type="text" name="civilStatus" value="<?=$account->civilStatus?>" class="form-control" required>
  </div>

  <div class="col-4 mt-2">
    <b>Gender</b>
    <select class="form-control" name="sex" required>
      <option><?=$account->sex?></option>
      <option value="">--Select--</option>
      <option>Male</option>
      <option>Female</option>
    </select>
  </div>

  <div class="col-4 mt-2">
    <b>Religion</b>
    <input type="text" name="religion" value="<?=$account->religion?>" class="form-control" required>
  </div>
  <div class="col-6 mt-2">
    <b>Email</b>
    <input type="text" name="email" value="<?=$account->email?>" class="form-control" required>
  </div>
  <div class="col-6 mt-2">
    <b>Mobile Number</b>
    <input type="number" name="phone" value="<?=$account->phone?>" class="form-control" required>
  </div>
  <div class="col-12 mt-2">
    <b>Address</b>
    <textarea name="address" class="form-control" required><?=$account->address?></textarea>
  </div>
  <div class="col-12 mt-2">
    <b>Education Background</b>
    <textarea name="educationalBackground" class="form-control" required><?=$account->educationalBackground?></textarea>
  </div>
  <div class="col-12 mt-2">
    <b>Teaching Experience</b>
    <textarea name="teachingExperience" class="form-control" required><?=$account->teachingExperience?></textarea>
  </div>


    <div class="col-4 mt-2">
      <b>SSS</b>
      <input type="text" name="sss" value="<?=$account->sss?>" class="form-control" required>
    </div>

    <div class="col-4 mt-2">
      <b>Phil Health</b>
      <input type="text" name="philHealth" value="<?=$account->philHealth?>" class="form-control" required>
    </div>


</div>

<button type="submit" class="btn btn-primary mt-2">Save</button>

</form>



<?php include $ROOT_DIR . "templates/footer.php"; ?>

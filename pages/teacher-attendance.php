<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

  $teacher_list = account()->list("role='Faculty' and isDeleted=0");
  $subject_list = subject()->list("isDeleted=0");

  $class_list = classes()->list("isDeleted=0");

  $dateNow = date("F d Y");

?>

<h2>Attendance for today (<?=$dateNow?>)</h2>

        <!-- Modal -->
        <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title">Class Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="process.php?action=class-save" id="addContactModalTitle" method="post">
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <b>Subject</b>
                    <select class="form-control" name="subjectId" required>
                      <option value="">--Select Subject--</option>
                      <?php foreach ($subject_list as $row): ?>
                          <option value="<?=$row->Id?>"><?=$row->name;?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-12">
                    <b>Class Code</b>
                    <input type="text" name="name" class="form-control" required>
                  </div>
                  <div class="col-12">
                    <b>Assign Teacher</b>
                    <select class="form-control" name="facultyId" required>
                      <option value="">--Select Faculty--</option>
                      <?php foreach ($teacher_list as $row): ?>
                          <option value="<?=$row->Id?>"><?=$row->firstName;?> <?=$row->lastName;?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-12">
                    <b>Time</b>
                    <select class="form-control" name="time" required>
                      <option value="">--Select Time--</option>
                      <option>8:30AM-9:30AM</option>
                      <option>9:30AM-10:30AM</option>
                      <option>10:30AM-11:30AM</option>
                      <option>1:00PM-2:00PM</option>
                      <option>2:00PM-3:00PM</option>
                      <option>3:00PM-4:00PM</option>
                      <option>4:00PM-5:00PM</option>
                    </select>
                  </div>

                  <div class="col-12">
                    <b>Days (eg. "MWF", "TTh")</b>
                    <input type="text" name="days" class="form-control" required>
                  </div>

                </div>
              </div>
              <div class="modal-footer">
                <button name="form-type" value="add" id="btn-add" class="btn btn-success rounded-pill px-4">Add</button>
                <button name="form-type" value="edit" id="btn-edit" class="btn btn-success rounded-pill px-4">Save</button>
                <button type="button" class="btn btn-danger rounded-pill px-4"  data-dismiss="modal" aria-label="Close"> Discard </button>
              </div>
            </form>
            </div>
          </div>
        </div>
        <div class="card card-body">
          <div class="table-responsive">
            <table class="table search-table align-middle text-nowrap">
              <thead class="header-item">
                <th>#</th>
                <th>Code</th>
                <th>Subject</th>
                <th>Faculty</th>
                <th>Schedule</th>
                <th width="10%">Action</th>
              </thead>
              <tbody>
                <!-- start row -->

                <?php
                $count = 0;
                foreach ($class_list as $row):
                  $date = date("Y-m-d");
                  $subject = subject()->get("Id=$row->subjectId");
                  $faculty = account()->get("Id=$row->facultyId");
                  $checkAttendanceExist = attendance()->count("dateAdded='$date' and  classId='$row->Id' and facultyId=$row->facultyId");
                  if ($checkAttendanceExist>0) {
                    $att  =attendance()->get("dateAdded='$date' and  classId='$row->Id' and facultyId=$row->facultyId");
                  }
                  $count += 1;
                   ?>

                <tr class="search-items">
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="ms-3">
                        <div class="user-meta-info">
                          <h6 class="user-name mb-0"
                          data-id="<?=$row->Id;?>"
                          ><?=$count;?></h6>
                        </div>
                      </div>
                    </div>
                  </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="ms-3">
                          <div class="user-meta-info">
                            <h6 class="mb-0"><?=$row->name;?></h6>
                          </div>
                        </div>
                      </div>
                    </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <div class="user-meta-info">
                              <h6 class="mb-0"><?=$subject->name;?></h6>
                            </div>
                          </div>
                        </div>
                      </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <div class="user-meta-info">
                                <h6 class="mb-0"><?=$faculty->firstName;?> <?=$faculty->lastName;?></h6>
                              </div>
                            </div>
                          </div>
                        </td>
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <div class="user-meta-info">
                                  <h6 class="mb-0"><?=$row->days;?>, <?=$row->time;?></h6>
                                </div>
                              </div>
                            </div>
                          </td>
                  <td>
                    <div class="action-btn">
                      <?php if ($checkAttendanceExist==0): ?>
                        <a href="process.php?action=attendance-change&status=Present&facultyId=<?=$row->facultyId?>&classId=<?=$row->Id?>" class="btn btn-primary">Present</a>
                        <a href="process.php?action=attendance-change&status=Late&facultyId=<?=$row->facultyId?>&classId=<?=$row->Id?>" class="btn btn-warning">Late</a>
                        <a href="process.php?action=attendance-change&status=Absent&facultyId=<?=$row->facultyId?>&classId=<?=$row->Id?>" class="btn btn-danger">Absent</a>
                        <?php else: ?>
                          <?=$att->status;?>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <!-- end row -->

              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <?php include $ROOT_DIR . "templates/footer.php"; ?>

      <script type="text/javascript">
      $(function () {

          $("#input-search").on("keyup", function () {
            var rex = new RegExp($(this).val(), "i");
            $(".search-table .search-items:not(.header-item)").hide();
            $(".search-table .search-items:not(.header-item)")
              .filter(function () {
                return rex.test($(this).text());
              })
              .show();
          });

          $("#btn-add-contact").on("click", function (event) {


            $("#addContactModal #btn-add").show();
            $("#addContactModal #btn-edit").hide();
            $("#addContactModal").modal("show");
          });


          function editContact() {
            $(".edit").on("click", function (event) {
              $("#addContactModal #btn-add").hide();
              $("#addContactModal #btn-edit").show();

              // Get Parents
              var getParentItem = $(this).parents(".search-items");
              var getModal = $("#addContactModal");

              // Get List Item Fields
              var $_name = getParentItem.find(".user-name");
              // Set Modal Field's Value
              getModal.find("#c-id").val($_name.attr("data-id"));
              getModal.find("#c-username").val($_name.attr("data-username"));
              getModal.find("#c-firstName").val($_name.attr("data-firstName"));
              getModal.find("#c-lastName").val($_name.attr("data-lastName"));
              if ($_name.attr("data-status")=="Inactive") {
                getModal.find("#c-display-password").val($_name.attr("data-password"));
              }
              else{
                getModal.find("#c-display-password").val("Not shown for security");
              }

              $("#addContactModal").modal("show");
            });
          }

          editContact();

        });
  </script>

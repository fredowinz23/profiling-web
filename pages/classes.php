<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

  $teacher_list = account()->list("role='Faculty' and isDeleted=0");
  $subject_list = subject()->list("isDeleted=0");

  $class_list = classes()->list("isDeleted=0");

?>


      <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center">
            <div class="col-9">
              <h4 class="fw-semibold mb-8">Classes</h4>
            </div>
            <div class="col-3">
              <div class="text-center mb-n5">
                <img src="../../dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="widget-content searchable-container list">
        <!-- --------------------- start Contact ---------------- -->
        <div class="card card-body">
          <div class="row">
            <div class="col-md-4 col-xl-3">
              <form class="position-relative">
                <input type="text" class="form-control product-search ps-5" id="input-search" placeholder="Search <?=$role?>..." />
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
              </form>
            </div>
            <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
              <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-info d-flex align-items-center">
                <i class="ti ti-users text-white me-1 fs-5"></i> Add Classes
              </a>
            </div>
          </div>
        </div>

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
                <input type="hidden" name="Id" id="id" value="">
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <b>Subject</b>
                    <select class="form-control" name="subjectId" required>
                      <option value="" id="subject">--Select Subject--</option>
                      <?php foreach ($subject_list as $row): ?>
                          <option value="<?=$row->Id?>"><?=$row->name;?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-12">
                    <b>Class Code</b>
                    <input type="text" id="name" name="name" class="form-control" required>
                  </div>
                  <div class="col-12">
                    <b>Assign Teacher</b>
                    <select class="form-control" name="facultyId" required>
                      <option value="" id="faculty">--Select Faculty--</option>
                      <?php foreach ($teacher_list as $row): ?>
                          <option value="<?=$row->Id?>"><?=$row->firstName;?> <?=$row->lastName;?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-12">
                    <b>Time</b>
                    <select class="form-control" name="time" required>
                      <option value="" id="time">--Select Time--</option>
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
                    <input type="text" id="days" name="days" class="form-control" required>
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
                  $subject = subject()->get("Id=$row->subjectId");
                  $faculty = account()->get("Id=$row->facultyId");
                  $count += 1;
                   ?>

                <tr class="search-items">
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="ms-3">
                        <div class="user-meta-info">
                          <h6 class="user-name mb-0"
                          data-id="<?=$row->Id;?>"
                          data-subject-id="<?=$subject->Id;?>"
                           data-subject-name="<?=$subject->name;?>"
                           data-name="<?=$row->name;?>"
                           data-faculty-id="<?=$faculty->Id;?>"
                           data-faculty-name="<?=$faculty->firstName;?> <?=$faculty->lastName;?>"
                           data-time="<?=$row->time;?>"
                           data-days="<?=$row->days;?>"
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
                      <a href="javascript:void(0)" class="text-info edit">
                        <i class="fa fa-eye fs-5"></i>
                      </a>
                      <a href="process.php?action=class-delete&Id=<?=$row->Id?>&url=<?=$current_url?>" class="text-dark ms-2">
                        <i class="fa fa-trash fs-5"></i>
                      </a>
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
              getModal.find("#id").val($_name.attr("data-id"));
              getModal.find("#subject").html($_name.attr("data-subject-name"));
              getModal.find("#subject").val($_name.attr("data-subject-id"));
              getModal.find("#name").val($_name.attr("data-name"));
              getModal.find("#faculty").val($_name.attr("data-faculty-id"));
              getModal.find("#faculty").html($_name.attr("data-faculty-name"));
              getModal.find("#time").val($_name.attr("data-time"));
              getModal.find("#time").html($_name.attr("data-time"));
              getModal.find("#days").val($_name.attr("data-days"));

              $("#addContactModal").modal("show");
            });
          }

          editContact();

        });
  </script>

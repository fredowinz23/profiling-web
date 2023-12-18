<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

  $attendance_list = attendance()->list("facultyId=$account->Id order by dateAdded");


?>

<h2>My Attendance</h2>

        <div class="card card-body">
          <div class="table-responsive">
            <table class="table search-table align-middle text-nowrap">
              <thead class="header-item">
                <th>#</th>
                <th>Date</th>
                <th>Code</th>
                <th>Subject</th>
                <th>Faculty</th>
                <th>Schedule</th>
                <th width="10%">Status</th>
              </thead>
              <tbody>
                <!-- start row -->

                <?php
                $count = 0;
                foreach ($attendance_list as $att):
                  $row = classes()->get("Id=$att->classId");
                  $date = date("Y-m-d");
                  $subject = subject()->get("Id=$row->subjectId");
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
                          ><?=$count;?></h6>
                        </div>
                      </div>
                    </div>
                  </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="ms-3">
                          <div class="user-meta-info">
                            <h6 class="mb-0"><?=$att->dateAdded;?></h6>
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
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <div class="user-meta-info">
                                  <h6 class="mb-0"><?=$att->status;?></h6>
                                </div>
                              </div>
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

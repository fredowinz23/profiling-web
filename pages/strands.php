<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

  $strand_list = strand()->list("isDeleted=0");


?>


      <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center">
            <div class="col-9">
              <h4 class="fw-semibold mb-8">Strands</h4>
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

          <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-info mt-3 mb-3">
            <i class="ti ti-users text-white me-1 fs-5"></i> Add Strand
          </a>

        <!-- Modal -->
        <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title">Strand Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="process.php?action=strand-save" id="addContactModalTitle" method="post">
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <b>Stand Code</b>
                    <input type="text" name="name" class="form-control" required>
                  </div>

                    <div class="col-12">
                      <b>Description</b>
                      <input type="text" name="description" class="form-control" required>
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
                <th>Name</th>
                <th>Description</th>
                <th width="10%">Action</th>
              </thead>
              <tbody>
                <!-- start row -->

                <?php
                $count = 0;
                foreach ($strand_list as $row):
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
                              <h6 class="mb-0"><?=$row->description;?></h6>
                            </div>
                          </div>
                        </div>
                      </td>
                  <td>
                    <div class="action-btn">
                      <a href="javascript:void(0)" class="text-info edit">
                        <i class="fa fa-eye fs-5"></i>
                      </a>
                      <a href="process.php?action=strand-delete&Id=<?=$row->Id?>&url=<?=$current_url?>" class="text-dark ms-2">
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

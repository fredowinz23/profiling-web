<!-- https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/index.html -->
<?php
session_start();
include_once($ROOT_DIR . "config/database.php");
include_once($ROOT_DIR . "config/Models.php");
$user = $_SESSION["user_session"];
$username = $user["username"];
$account = account()->get("username='$username'");
$role = $account->role;

$success = get_query_string("success", "");
$error = get_query_string("error", "");

?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CHMSU Food plaza payment management system</title>
  <link rel="shortcut icon" type="image/png" href="<?=$ROOT_DIR;?>templates/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="<?=$ROOT_DIR;?>templates/assets/css/styles.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="index.php" class="text-nowrap logo-img">
            <img src="<?=$ROOT_DIR;?>templates/assets/images/logos/dark-logo.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>

            <?php if ($role=="Admin"): ?>
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">ACCOUNTS</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="accounts.php?role=Admin" aria-expanded="false">
                  <span>
                    <i class="ti ti-article"></i>
                  </span>
                  <span class="hide-menu">Admins</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="accounts.php?role=Student" aria-expanded="false">
                  <span>
                    <i class="ti ti-alert-circle"></i>
                  </span>
                  <span class="hide-menu">Students</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="accounts.php?role=Staff" aria-expanded="false">
                  <span>
                    <i class="ti ti-cards"></i>
                  </span>
                  <span class="hide-menu">Staffs</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="accounts.php?role=Faculty" aria-expanded="false">
                  <span>
                    <i class="ti ti-file-description"></i>
                  </span>
                  <span class="hide-menu">Faculty</span>
                </a>
              </li>
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">SETTINGS</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="cash-in.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-login"></i>
                  </span>
                  <span class="hide-menu">E-cash Loading</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="categories.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-user-plus"></i>
                  </span>
                  <span class="hide-menu">Inventory</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="orders.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-adjustments-alt"></i>
                  </span>
                  <span class="hide-menu">Orders</span>
                </a>
              </li>
            <?php endif; ?>

            <?php if ($role=="Student" || $role=="Faculty"): ?>


              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">OPTIONS</span>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="food-categories.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-cards"></i>
                  </span>
                  <span class="hide-menu">Food List</span>
                </a>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="cart.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-cards"></i>
                  </span>
                  <span class="hide-menu">My Cart</span>
                </a>
              </li>


                <li class="sidebar-item">
                  <a class="sidebar-link" href="purchase-history.php" aria-expanded="false">
                    <span>
                      <i class="ti ti-cards"></i>
                    </span>
                    <span class="hide-menu">Purchase History</span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="load-history.php" aria-expanded="false">
                    <span>
                      <i class="ti ti-cards"></i>
                    </span>
                    <span class="hide-menu">Load History</span>
                  </a>
                </li>

            <?php endif; ?>

          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="<?=$ROOT_DIR;?>templates/assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3"><?=$account->firstName;?> <?=$account->lastName;?> (<?=$role;?>)</p>
                    </a>
                    <a href="../auth/process.php?action=user-logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">

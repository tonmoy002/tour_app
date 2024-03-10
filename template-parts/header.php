<?php 
 include('../inc/user.php');
 include('../inc/settings.php');
 use userlib\User;
 use webSettings\Settings;
 $settings = new Settings();
 $site_config = $settings->get_settng_for_user();

 $user = new User();
 if(!$user->logged_in()){
  header("Location:".$site_config->admin_url."login.php");
 }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $site_config->title;?> Admin</title>
    <link rel="stylesheet" href="<?php echo $site_config->admin_url;?>assets/vendors/css/select2.min.css">
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo $site_config->admin_url;?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo $site_config->admin_url;?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?php echo $site_config->admin_url;?>assets/datepicker/dist/datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo $site_config->admin_url;?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $site_config->admin_url;?>assets/css/custom.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo $site_config->admin_url;?>uploads/<?php echo $site_config->favicon;?>" />
  </head>
  <body>
     <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center"></div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile ">
              <a class="nav-link" href="<?php echo $site_config->admin_url;?>settings" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="<?php echo $site_config->admin_url;?>assets/images/faces/face1.jpg" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?php echo $user->get_username();?></p>
                </div>
              </a>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="<?php echo $site_config->admin_url;?>logout.php" title="Logout">
                <i class="mdi mdi-power"></i>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
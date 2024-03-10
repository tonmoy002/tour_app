<?php 
 include('inc/user.php');
 include('inc/settings.php');
 use userlib\User;
 $user = new User();
 use webSettings\Settings;
 $settings = new Settings();
 $site_config = $settings->get_settng_for_user();

 if(!$user->logged_in(False)){
  header("Location:".$site_config->admin_url."dashboard");
 }else{
  $user->error_message_genrate(); 
 }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $site_config->title;?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo $site_config->admin_url;?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo $site_config->admin_url;?>assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo $site_config->admin_url;?>assets/css/style.css">

    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo $site_config->admin_url;?>uploads/<?php echo $site_config->favicon;?>" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <!-- <h4>Hello! let's hear some music</h4> -->
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" action="<?php echo $site_config->admin_url;?>inc/login.php" method="post">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="username">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="login">SIGN IN</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                    </div>
                    <a href="#" class="auth-link text-black">Forgot password?</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo $site_config->admin_url;?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo $site_config->admin_url;?>assets/js/hoverable-collapse.js"></script>
    <script src="<?php echo $site_config->admin_url;?>assets/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>
